<?php
declare(strict_types=1);

namespace EricMartinez\Blog\Model\ResourceModel\Post;

use EricMartinez\Blog\Model\Post;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'post_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(
            Post::class,
            \EricMartinez\Blog\Model\ResourceModel\Post::class
        );
    }
}
