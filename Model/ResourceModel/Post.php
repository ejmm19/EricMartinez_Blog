<?php
declare(strict_types=1);

namespace EricMartinez\Blog\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Post extends AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init('ericmartinez_blog_post', 'post_id');
    }
}
