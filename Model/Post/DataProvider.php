<?php
namespace EricMartinez\Blog\Model\Post;

use EricMartinez\Blog\Model\ResourceModel\Post\CollectionFactory;
use EricMartinez\Blog\Model\ImageUploader;
use Magento\Framework\Filesystem;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Ui\DataProvider\AbstractDataProvider;

class DataProvider extends AbstractDataProvider
{
    protected $_loadedData;
    protected $imageUploader;
    protected $filesystem;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        ImageUploader $imageUploader,
        Filesystem $filesystem,
        array $meta = [],
        array $data = []
    )
    {
        $this->collection = $collectionFactory->create();
        $this->imageUploader = $imageUploader;
        $this->filesystem = $filesystem;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->_loadedData)) {
            return $this->_loadedData;
        }
        $items = $this->collection->getItems();
        /** @var \EricMartinez\Blog\Model\Post $post */
        foreach ($items as $post) {
            $postData = $post->getData();
            $coverImage = $post->getCoverImage();
            if ($coverImage) {
                unset($postData['cover_image']);
                $mediaDirectory = $this->filesystem->getDirectoryRead(DirectoryList::MEDIA);
                $filePath = $this->imageUploader->getFilePath(ImageUploader::BASE_PATH, $coverImage);
                try {
                    $fileSize = $mediaDirectory->stat($filePath)['size'];
                    $postData['cover_image'][0]['name'] = $coverImage;
                    $postData['cover_image'][0]['url'] = $this->imageUploader->getMediaUrl($coverImage);
                    $postData['cover_image'][0]['size'] = $fileSize;
                } catch (\Magento\Framework\Exception\FileSystemException $e) {
                    // File does not exist, do nothing
                }
            }
            $this->_loadedData[$post->getId()] = $postData;
        }
        return $this->_loadedData;
    }
}