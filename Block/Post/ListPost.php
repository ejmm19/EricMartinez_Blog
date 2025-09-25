<?php
namespace EricMartinez\Blog\Block\Post;

use Magento\Framework\View\Element\Template;
use EricMartinez\Blog\Model\ResourceModel\Post\CollectionFactory;
use EricMartinez\Blog\Model\ImageUploader;

class ListPost extends Template
{
    protected $collectionFactory;
    protected $imageUploader;

    public function __construct(
        Template\Context $context,
        CollectionFactory $collectionFactory,
        ImageUploader $imageUploader,
        array $data = []
    )
    {
        $this->collectionFactory = $collectionFactory;
        $this->imageUploader = $imageUploader;
        parent::__construct($context, $data);
    }

    public function getPosts()
    {
        $collection = $this->collectionFactory->create();
        $collection->addFieldToFilter('is_active', 1);
        $collection->setOrder('created_at', 'DESC');
        return $collection;
    }

    public function getImageUrl(string $imageName): string
    {
        return $this->imageUploader->getMediaUrl($imageName);
    }
}
