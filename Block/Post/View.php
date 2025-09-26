<?php
declare(strict_types=1);

namespace EricMartinez\Blog\Block\Post;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use EricMartinez\Blog\Model\ResourceModel\Post\CollectionFactory as PostCollectionFactory;
use Magento\Framework\App\RequestInterface;

class View extends Template
{
    /**
     * @var PostCollectionFactory
     */
    protected $postCollectionFactory;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var \EricMartinez\Blog\Model\Post|null
     */
    protected $currentPost = null;

    /**
     * View constructor.
     * @param Context $context
     * @param PostCollectionFactory $postCollectionFactory
     * @param RequestInterface $request
     * @param array $data
     */
    protected $filterProvider;

    public function __construct(
        Context $context,
        PostCollectionFactory $postCollectionFactory,
        RequestInterface $request,
        \Magento\Cms\Model\Template\FilterProvider $filterProvider,
        array $data = []
    ) {
        $this->postCollectionFactory = $postCollectionFactory;
        $this->request = $request;
        $this->filterProvider = $filterProvider;
        parent::__construct($context, $data);
    }

    public function filterContent($content): string
    {
        return $this->filterProvider->getBlockFilter()->filter($content);
    }

    /**
     * Get current post
     *
     * @return \EricMartinez\Blog\Model\Post|null
     */
    public function getCurrentPost()
    {
        if ($this->currentPost === null) {
            $postId = (int)$this->request->getParam('id');
            if ($postId) {
                $collection = $this->postCollectionFactory->create();
                $collection->addFieldToFilter('post_id', $postId);
                $this->currentPost = $collection->getFirstItem();
                if (!$this->currentPost->getId()) {
                    $this->currentPost = null; // Post not found
                }
            }
        }
        return $this->currentPost;
    }

    /**
     * Get post cover image URL
     *
     * @param string $imageName
     * @return string
     */
    public function getImageUrl(string $imageName): string
    {
        return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . 'blog/post/' . $imageName;
    }
}
