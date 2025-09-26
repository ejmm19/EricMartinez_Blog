<?php
declare(strict_types=1);

namespace EricMartinez\Blog\Controller\Adminhtml\Comment;

use Magento\Backend\App\Action;
use EricMartinez\Blog\Api\CommentRepositoryInterface;
use Magento\Framework\Controller\ResultFactory;

class Delete extends Action
{
    private $commentRepository;

    public function __construct(
        Action\Context $context,
        CommentRepositoryInterface $commentRepository
    ) {
        $this->commentRepository = $commentRepository;
        parent::__construct($context);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        if ($id) {
            try {
                $this->commentRepository->deleteById((int)$id);
                $this->messageManager->addSuccessMessage(__('The comment has been deleted.'));
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            }
        }
        return $resultRedirect->setPath('*/*/');
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('EricMartinez_Blog::comment');
    }
}
