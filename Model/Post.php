<?php
declare(strict_types=1);

namespace EricMartinez\Blog\Model;

use Magento\Framework\Model\AbstractModel;

class Post extends AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(\EricMartinez\Blog\Model\ResourceModel\Post::class);
    }
}
