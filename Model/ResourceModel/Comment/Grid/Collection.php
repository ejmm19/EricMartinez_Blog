<?php
declare(strict_types=1);

namespace EricMartinez\Blog\Model\ResourceModel\Comment\Grid;

use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;

class Collection extends SearchResult
{
    protected function _initSelect()
    {
        parent::_initSelect();

        $this->getSelect()->joinLeft(
            ['post' => $this->getTable('ericmartinez_blog_post')],
            'main_table.post_id = post.post_id',
            ['post_title' => 'post.title']
        );

        return $this;
    }
}
