<?php
namespace EricMartinez\Blog\Controller\Adminhtml\Post;

use Magento\Backend\App\Action;
use EricMartinez\Blog\Api\PostRepositoryInterface;

class Delete extends Action
{
    /**
     * @var PostRepositoryInterface
     */
    protected $postRepository;

    /**
     * @param Action\Context $context
     * @param PostRepositoryInterface $postRepository
     */
    public function __construct(
        Action\Context $context,
        PostRepositoryInterface $postRepository
    )
    {
        parent::__construct($context);
        $this->postRepository = $postRepository;
    }

    /**
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('post_id');
        if ($id) {
            try {
                $this->postRepository->deleteById($id);
                $this->messageManager->addSuccessMessage(__('You deleted the post.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['post_id' => $id]);
            }
        }
        $this->messageManager->addErrorMessage(__("We can't find a post to delete."));
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
