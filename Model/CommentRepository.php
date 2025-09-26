<?php
declare(strict_types=1);

namespace EricMartinez\Blog\Model;

use EricMartinez\Blog\Api\CommentRepositoryInterface;
use EricMartinez\Blog\Api\Data\CommentInterface;
use EricMartinez\Blog\Api\Data\CommentInterfaceFactory;
use EricMartinez\Blog\Api\Data\CommentSearchResultsInterface;
use EricMartinez\Blog\Api\Data\CommentSearchResultsInterfaceFactory;
use EricMartinez\Blog\Model\ResourceModel\Comment as CommentResource;
use EricMartinez\Blog\Model\ResourceModel\Comment\CollectionFactory as CommentCollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

class CommentRepository implements CommentRepositoryInterface
{
    private CommentResource $resource;
    private CommentInterfaceFactory $commentFactory;
    private CommentCollectionFactory $collectionFactory;
    private CollectionProcessorInterface $collectionProcessor;
    private CommentSearchResultsInterfaceFactory $searchResultsFactory;

    public function __construct(
        CommentResource $resource,
        CommentInterfaceFactory $commentFactory,
        CommentCollectionFactory $collectionFactory,
        CollectionProcessorInterface $collectionProcessor,
        CommentSearchResultsInterfaceFactory $searchResultsFactory
    )
    {
        $this->resource = $resource;
        $this->commentFactory = $commentFactory;
        $this->collectionFactory = $collectionFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->searchResultsFactory = $searchResultsFactory;
    }

    public function save(CommentInterface $comment): CommentInterface
    {
        try {
            $this->resource->save($comment);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $comment;
    }

    public function getById(int $commentId): CommentInterface
    {
        $comment = $this->commentFactory->create();
        $this->resource->load($comment, $commentId);
        if (!$comment->getCommentId()) {
            throw new NoSuchEntityException(__('Comment with id "%1" does not exist.', $commentId));
        }
        return $comment;
    }

    public function getList(SearchCriteriaInterface $searchCriteria): CommentSearchResultsInterface
    {
        $collection = $this->collectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }

    public function delete(CommentInterface $comment): bool
    {
        try {
            $this->resource->delete($comment);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }

    public function deleteById(int $commentId): bool
    {
        return $this->delete($this->getById($commentId));
    }
}
