<?php
declare(strict_types=1);

namespace EricMartinez\Blog\Model\ResourceModel\Post\Grid;

use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;
use Magento\Framework\Data\Collection\Db\FetchStrategyInterface as FetchStrategy;
use Magento\Framework\Data\Collection\EntityFactoryInterface as EntityFactory;
use Magento\Framework\Event\ManagerInterface as EventManager;
use Psr\Log\LoggerInterface as Logger;

class Collection extends SearchResult
{
    public function __construct(
        EntityFactory $entityFactory,
        Logger $logger,
        FetchStrategy $fetchStrategy,
        EventManager $eventManager,
        $mainTable = 'ericmartinez_blog_post',
        $resourceModel = 'EricMartinez\Blog\Model\ResourceModel\Post'
    )
    {
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $mainTable, $resourceModel);
    }

    protected function _initSelect()
    {
        parent::_initSelect();

        $this->getSelect()->joinLeft(
            ['au' => $this->getTable('admin_user')],
            'main_table.admin_user_id = au.user_id',
            []
        )->joinLeft(
            ['ce' => $this->getTable('customer_entity')],
            'main_table.customer_id = ce.entity_id',
            []
        )->columns([
            'author' => new \Zend_Db_Expr('COALESCE(CONCAT(au.firstname, " ", au.lastname), CONCAT(ce.firstname, " ", ce.lastname))')
        ]);

        return $this;
    }
}
