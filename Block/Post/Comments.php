<?php
declare(strict_types=1);

namespace EricMartinez\Blog\Block\Post;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use EricMartinez\Blog\Api\PostRepositoryInterface;
use EricMartinez\Blog\Api\CommentRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Registry;
use Magento\Customer\Model\Session as CustomerSession;

class Comments extends Template
{
    private $postRepository;
    private $commentRepository;
    private $searchCriteriaBuilder;
    private $registry;
    private $customerSession;

    public function __construct(
        Context $context,
        PostRepositoryInterface $postRepository,
        CommentRepositoryInterface $commentRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        Registry $registry,
        CustomerSession $customerSession,
        array $data = []
    ) {
        $this->postRepository = $postRepository;
        $this->commentRepository = $commentRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->registry = $registry;
        $this->customerSession = $customerSession;
        parent::__construct($context, $data);
    }

    public function getPost()
    {
        return $this->getParentBlock()->getCurrentPost();
    }

    public function getComments()
    {
        $post = $this->getPost();
        if (!$post) {
            return [];
        }

        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter('post_id', $post->getId())
            ->addFilter('status', 1) // Approved
            ->create();

        return $this->commentRepository->getList($searchCriteria)->getItems();
    }

    public function getFormAction()
    {
        return $this->getUrl('blog/post/comment');
    }

    public function isCustomerLoggedIn()
    {
        return $this->customerSession->isLoggedIn();
    }
}
