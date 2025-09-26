<?php
declare(strict_types=1);

namespace EricMartinez\Blog\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface CommentSearchResultsInterface extends SearchResultsInterface
{
    /**
     * @return \EricMartinez\Blog\Api\Data\CommentInterface[]
     */
    public function getItems();

    /**
     * @param \EricMartinez\Blog\Api\Data\CommentInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
