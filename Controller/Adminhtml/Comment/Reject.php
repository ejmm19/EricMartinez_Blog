<?php
declare(strict_types=1);

namespace EricMartinez\Blog\Controller\Adminhtml\Comment;

use Magento\Backend\App\Action;
use EricMartinez\Blog\Api\CommentRepositoryInterface;
use Magento\Framework\Controller\ResultFactory;

class Reject extends Action
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
                $comment = $this->commentRepository->getById((int)$id);
                $comment->setStatus(2);
                $this->commentRepository->save($comment);
                $this->messageManager->addSuccessMessage(__('The comment has been rejected.'));
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
