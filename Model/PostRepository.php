<?php
declare(strict_types=1);

namespace EricMartinez\Blog\Model;

use EricMartinez\Blog\Api\Data\PostInterface;
use EricMartinez\Blog\Api\Data\PostInterfaceFactory;
use EricMartinez\Blog\Api\PostRepositoryInterface;
use EricMartinez\Blog\Model\ResourceModel\Post as PostResource;
use EricMartinez\Blog\Model\ResourceModel\Post\CollectionFactory as PostCollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use EricMartinez\Blog\Api\Data\PostSearchResultsInterfaceFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Cms\Model\Template\FilterProvider;
use Magento\Framework\Api\SearchCriteriaBuilder; // Added this

class PostRepository implements PostRepositoryInterface
{
    /**
     * @var PostResource
     */
    protected $resource;

    /**
     * @var PostFactory
     */
    protected $postFactory;

    /**
     * @var PostCollectionFactory
     */
    protected $postCollectionFactory;

    /**
     * @var PostSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * @var FilterProvider
     */
    protected $filterProvider;

    /**
     * @var PostInterfaceFactory
     */
    protected $dataPostFactory;

    /**
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    /**
     * @param PostResource $resource
     * @param PostFactory $postFactory
     * @param PostCollectionFactory $postCollectionFactory
     * @param PostSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param FilterProvider $filterProvider
     * @param PostInterfaceFactory $dataPostFactory
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        PostResource $resource,
        PostFactory $postFactory,
        PostCollectionFactory $postCollectionFactory,
        PostSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor,
        FilterProvider $filterProvider,
        PostInterfaceFactory $dataPostFactory,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->resource = $resource;
        $this->postFactory = $postFactory;
        $this->postCollectionFactory = $postCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->filterProvider = $filterProvider;
        $this->dataPostFactory = $dataPostFactory;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * {@inheritdoc}
     */
    public function save(PostInterface $post): PostInterface
    {
        try {
            $this->resource->save($post);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $post;
    }

    /**
     * {@inheritdoc}
     */
    public function getById(int $postId): PostInterface
    {
        $post = $this->postFactory->create();
        $this->resource->load($post, $postId);
        if (!$post->getId()) {
            throw new NoSuchEntityException(__('Post with id "%1" does not exist.', $postId));
        }

        // Filter WYSIWYG content
        $post->setContent($this->filterProvider->getBlockFilter()->filter($post->getContent()));

        return $post;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(?SearchCriteriaInterface $searchCriteria = null): \EricMartinez\Blog\Api\Data\PostSearchResultsInterface
    {
        if ($searchCriteria === null) {
            $searchCriteria = $this->searchCriteriaBuilder->create();
        }

        /** @var \EricMartinez\Blog\Model\ResourceModel\Post\Collection $collection */
        $collection = $this->postCollectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, $collection);

        /** @var \EricMartinez\Blog\Api\Data\PostSearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        // Filter WYSIWYG content for each item in the collection
        foreach ($searchResults->getItems() as $post) {
            $post->setContent($this->filterProvider->getBlockFilter()->filter($post->getContent()));
        }

        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function getAllPosts(): array
    {
        $collection = $this->postCollectionFactory->create();
        $posts = [];
        foreach ($collection->getItems() as $post) {
            // Filter WYSIWYG content
            $post->setContent($this->filterProvider->getBlockFilter()->filter($post->getContent()));
            $posts[] = $post;
        }
        return $posts;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(PostInterface $post): bool
    {
        try {
            $this->resource->delete($post);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById(int $postId): bool
    {
        return $this->delete($this->getById($postId));
    }
}