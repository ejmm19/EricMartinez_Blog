<?php
declare(strict_types=1);

namespace EricMartinez\Blog\Controller\Post;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\LocalizedException;
use EricMartinez\Blog\Api\CommentRepositoryInterface;
use EricMartinez\Blog\Api\Data\CommentInterfaceFactory;
use Magento\Customer\Model\Session as CustomerSession;
use Magento\Framework\Data\Form\FormKey\Validator as FormKeyValidator;

class Comment extends Action
{
    private $commentRepository;
    private $commentFactory;
    private $customerSession;
    private $formKeyValidator;

    public function __construct(
        Context $context,
        CommentRepositoryInterface $commentRepository,
        CommentInterfaceFactory $commentFactory,
        CustomerSession $customerSession,
        FormKeyValidator $formKeyValidator
    ) {
        $this->commentRepository = $commentRepository;
        $this->commentFactory = $commentFactory;
        $this->customerSession = $customerSession;
        $this->formKeyValidator = $formKeyValidator;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $post = $this->getRequest()->getPostValue();

        if (!$post || !$this->formKeyValidator->validate($this->getRequest())) {
            $this->messageManager->addErrorMessage(__('Invalid form key. Please try again.'));
            return $resultRedirect->setPath('*/*/');
        }

        try {
            $postId = (int)$this->getRequest()->getParam('post_id');
            if (!$postId) {
                throw new LocalizedException(__('Post ID is missing.'));
            }

            $comment = $this->commentFactory->create();
            $comment->setPostId($postId);

            if ($this->customerSession->isLoggedIn()) {
                $comment->setCustomerId($this->customerSession->getCustomerId());
            } else {
                $comment->setGuestName($post['guest_name']);
                $comment->setGuestEmail($post['guest_email']);
            }

            $comment->setContent($post['content']);
            $comment->setStatus(0); // Pending

            $this->commentRepository->save($comment);
            $this->messageManager->addSuccessMessage(__('Your comment has been submitted for moderation.'));
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the comment.'));
        }

        return $resultRedirect->setRefererOrBaseUrl();
    }
}
