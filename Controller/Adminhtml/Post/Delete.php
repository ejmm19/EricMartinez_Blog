<?php
namespace EricMartinez\Blog\Controller\Adminhtml\Post;

use Magento\Backend\App\Action;
use EricMartinez\Blog\Model\PostFactory;

class Delete extends Action
{
    /**
     * @var PostFactory
     */
    protected $postFactory;

    /**
     * @param Action\Context $context
     * @param PostFactory $postFactory
     */
    public function __construct(
        Action\Context $context,
        PostFactory $postFactory
    )
    {
        parent::__construct($context);
        $this->postFactory = $postFactory;
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
                $model = $this->postFactory->create();
                $model->load($id);
                $model->delete();
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
