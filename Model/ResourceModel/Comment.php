<?php
declare(strict_types=1);

namespace EricMartinez\Blog\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Comment extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('ericmartinez_blog_comment', 'comment_id');
    }
}
