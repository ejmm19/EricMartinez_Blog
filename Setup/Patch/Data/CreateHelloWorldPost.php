<?php
namespace EricMartinez\Blog\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use EricMartinez\Blog\Model\PostFactory;
use EricMartinez\Blog\Api\PostRepositoryInterface;
use Magento\User\Model\ResourceModel\User\CollectionFactory as UserCollectionFactory;
use Magento\Framework\Api\SearchCriteriaBuilder;

class CreateHelloWorldPost implements DataPatchInterface
{
    private $moduleDataSetup;
    private $postFactory;
    private $postRepository;
    private $userCollectionFactory;
    private $searchCriteriaBuilder;

    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        PostFactory $postFactory,
        PostRepositoryInterface $postRepository,
        UserCollectionFactory $userCollectionFactory,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->postFactory = $postFactory;
        $this->postRepository = $postRepository;
        $this->userCollectionFactory = $userCollectionFactory;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    public function apply()
    {
        $this->moduleDataSetup->startSetup();

        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter('url_key', 'hello-world')
            ->create();

        $postList = $this->postRepository->getList($searchCriteria);

        if ($postList->getTotalCount() === 0) {
            // Post does not exist, create it
            $adminUser = $this->getFirstAdminUser();
            if ($adminUser) {
                $newPost = $this->postFactory->create();
                $newPost->setTitle('Hello World');
                $newPost->setUrlKey('hello-world');
                $newPost->setContent('This is a sample post created during module installation.');
                $newPost->setAdminUserId($adminUser->getId());
                $this->postRepository->save($newPost);
            }
        }

        $this->moduleDataSetup->endSetup();
    }

    private function getFirstAdminUser()
    {
        $userCollection = $this->userCollectionFactory->create();
        $userCollection->addFilter('is_active', 1);
        $userCollection->setPageSize(1)->setCurPage(1);

        return $userCollection->getFirstItem();
    }

    public static function getDependencies()
    {
        return [];
    }

    public function getAliases()
    {
        return [];
    }
}
