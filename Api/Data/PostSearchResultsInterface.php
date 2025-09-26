<?php
declare(strict_types=1);

namespace EricMartinez\Blog\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface PostSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get posts list.
     *
     * @return \EricMartinez\Blog\Api\Data\PostInterface[]
     */
    public function getItems();

    /**
     * Set posts list.
     *
     * @param \EricMartinez\Blog\Api\Data\PostInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}