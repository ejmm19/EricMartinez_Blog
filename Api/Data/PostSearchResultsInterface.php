<?php
namespace EricMartinez\Blog\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface PostSearchResultsInterface extends SearchResultsInterface
{
    /**
     * @return \EricMartinez\Blog\Api\Data\PostInterface[]
     */
    public function getItems();

    /**
     * @param \EricMartinez\Blog\Api\Data\PostInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
