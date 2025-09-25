<?php
namespace EricMartinez\Blog\Api;

use EricMartinez\Blog\Api\Data\PostInterface;
use EricMartinez\Blog\Api\Data\PostSearchResultsInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

interface PostRepositoryInterface
{
    /**
     * @param \EricMartinez\Blog\Api\Data\PostInterface $post
     * @return \EricMartinez\Blog\Api\Data\PostInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(PostInterface $post);

    /**
     * @param int $postId
     * @return \EricMartinez\Blog\Api\Data\PostInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($postId);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \EricMartinez\Blog\Api\Data\PostSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * @param \EricMartinez\Blog\Api\Data\PostInterface $post
     * @return bool
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(PostInterface $post);

    /**
     * @param int $postId
     * @return bool
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($postId);
}
