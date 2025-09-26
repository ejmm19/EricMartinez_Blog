<?php
declare(strict_types=1);

namespace EricMartinez\Blog\Api;

use EricMartinez\Blog\Api\Data\CommentInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use EricMartinez\Blog\Api\Data\CommentSearchResultsInterface;

interface CommentRepositoryInterface
{
    public function save(CommentInterface $comment): CommentInterface;

    public function getById(int $commentId): CommentInterface;

    public function getList(SearchCriteriaInterface $searchCriteria): CommentSearchResultsInterface;

    public function delete(CommentInterface $comment): bool;

    public function deleteById(int $commentId): bool;
}
