<?php
namespace EricMartinez\Blog\Controller\Adminhtml\Post;

use Magento\Backend\App\Action;
use EricMartinez\Blog\Model\PostFactory;
use EricMartinez\Blog\Api\PostRepositoryInterface;
use EricMartinez\Blog\Model\ImageUploader;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Backend\Model\Auth\Session as AuthSession;

class Save extends Action
{
    protected PostFactory $postFactory;
    protected DataPersistorInterface $dataPersistor;
    protected AuthSession $authSession;
    protected PostRepositoryInterface $postRepository;
    protected ImageUploader $imageUploader;

    public function __construct(
        Action\Context $context,
        PostFactory $postFactory,
        PostRepositoryInterface $postRepository,
        DataPersistorInterface $dataPersistor,
        AuthSession $authSession,
        ImageUploader $imageUploader
    )
    {
        parent::__construct($context);
        $this->postFactory = $postFactory;
        $this->postRepository = $postRepository;
        $this->dataPersistor = $dataPersistor;
        $this->authSession = $authSession;
        $this->imageUploader = $imageUploader;
    }

    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            $id = $this->getRequest()->getParam('post_id');

            if (empty($id)) {
                $model = $this->postFactory->create();
            } else {
                try {
                    $model = $this->postRepository->getById($id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This post no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            }

            if (isset($data['cover_image'][0]['name'])) {
                $data['cover_image'] = $this->imageUploader->moveFileFromTmp($data['cover_image'][0]['name']);
            } elseif (isset($data['cover_image'][0]['url'])) {
                $data['cover_image'] = basename($data['cover_image'][0]['url']);
            } else {
                $data['cover_image'] = null;
            }

            if (!$model->getId()) {
                $data['admin_user_id'] = $this->authSession->getUser()->getId();
            }

            $model->setData($data);

            try {
                $this->postRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the post.'));
                $this->dataPersistor->clear('blog_post');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['post_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the post.'));
            }

            $this->dataPersistor->set('blog_post', $data);
            return $resultRedirect->setPath('*/*/edit', ['post_id' => $this->getRequest()->getParam('post_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('EricMartinez_Blog::post');
    }
}
