<?php
declare(strict_types=1);

namespace EricMartinez\Blog\Model;

use EricMartinez\Blog\Api\Data\CommentSearchResultsInterface;
use Magento\Framework\Api\SearchResults;

class CommentSearchResults extends SearchResults implements CommentSearchResultsInterface
{
}
