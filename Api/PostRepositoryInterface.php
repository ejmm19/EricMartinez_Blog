<?php
declare(strict_types=1);

namespace EricMartinez\Blog\Api;

use EricMartinez\Blog\Api\Data\PostInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use EricMartinez\Blog\Api\Data\PostSearchResultsInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\CouldNotDeleteException;

interface PostRepositoryInterface
{
    /**
     * Save post.
     *
     * @param \EricMartinez\Blog\Api\Data\PostInterface $post
     * @return \EricMartinez\Blog\Api\Data\PostInterface
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(PostInterface $post): PostInterface;

    /**
     * Retrieve post by ID.
     *
     * @param int $postId
     * @return \EricMartinez\Blog\Api\Data\PostInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById(int $postId): PostInterface;

    /**
     * Retrieve posts matching the specified search criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \EricMartinez\Blog\Api\Data\PostSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): PostSearchResultsInterface;

    /**
     * Retrieve all posts.
     *
     * @return \EricMartinez\Blog\Api\Data\PostInterface[]
     */
    public function getAllPosts(): array;

    /**
     * Delete post.
     *
     * @param \EricMartinez\Blog\Api\Data\PostInterface $post
     * @return bool true on success
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(PostInterface $post): bool;

    /**
     * Delete post by ID.
     *
     * @param int $postId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteById(int $postId): bool;
}