<?php
declare(strict_types=1);

namespace EricMartinez\Blog\Model;

use EricMartinez\Blog\Api\Data\PostSearchResultsInterface;
use Magento\Framework\Api\SearchResults;

class PostSearchResults extends SearchResults implements PostSearchResultsInterface
{
}
