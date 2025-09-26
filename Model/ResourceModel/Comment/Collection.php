<?php
declare(strict_types=1);

namespace EricMartinez\Blog\Model\ResourceModel\Comment;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'comment_id';

    protected function _construct()
    {
        $this->_init(
            \EricMartinez\Blog\Model\Comment::class,
            \EricMartinez\Blog\Model\ResourceModel\Comment::class
        );
    }
}
