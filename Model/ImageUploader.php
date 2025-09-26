<?php
namespace EricMartinez\Blog\Model;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Filesystem;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\MediaStorage\Model\File\UploaderFactory;

class ImageUploader
{
    const BASE_TMP_PATH = 'blog/tmp/post';
    const BASE_PATH = 'blog/post';
    const ALLOWED_EXTENSIONS = ['jpg', 'jpeg', 'gif', 'png'];

    protected $filesystem;
    protected $storeManager;
    protected $uploaderFactory;
    protected \Psr\Log\LoggerInterface $logger;

    public function __construct(
        Filesystem $filesystem,
        StoreManagerInterface $storeManager,
        UploaderFactory $uploaderFactory,
        \Psr\Log\LoggerInterface $logger
    )
    {
        $this->filesystem = $filesystem;
        $this->storeManager = $storeManager;
        $this->uploaderFactory = $uploaderFactory;
        $this->logger = $logger;
    }

    public function saveFileToTmpDir($fileId)
    {
        $this->logger->critical('Entering saveFileToTmpDir method.');
        $this->logger->info('$_FILES content: ' . print_r($_FILES, true));
        $mediaDirectory = $this->filesystem->getDirectoryWrite(DirectoryList::MEDIA);
        $baseTmpPath = self::BASE_TMP_PATH;

        /** @var \Magento\MediaStorage\Model\File\Uploader $uploader */
        $uploader = $this->uploaderFactory->create(['fileId' => $fileId]);
        $uploader->setAllowedExtensions(self::ALLOWED_EXTENSIONS);
        $uploader->setAllowRenameFiles(true);

        try {
            $result = $uploader->save($mediaDirectory->getAbsolutePath($baseTmpPath));
        } catch (\Exception $e) {
            $this->logger->critical($e);
            throw new LocalizedException(
                __('File can not be saved to the temporary folder. Original error: %1', $e->getMessage())
            );
        }

        if (!$result) {
            throw new LocalizedException(
                __('File can not be saved to the destination folder.')
            );
        }

        $result['url'] = $this->storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA)
            . $this->getFilePath($baseTmpPath, $result['file']);

        return $result;
    }
    
    public function moveFileFromTmp($imageName)
    {
        $baseTmpPath = self::BASE_TMP_PATH;
        $basePath = self::BASE_PATH;

        $baseImagePath = $this->getFilePath($basePath, $imageName);
        $baseTmpImagePath = $this->getFilePath($baseTmpPath, $imageName);

        try {
            $mediaDirectory = $this->filesystem->getDirectoryWrite(DirectoryList::MEDIA);
            $mediaDirectory->renameFile($baseTmpImagePath, $baseImagePath);
        } catch (LocalizedException $e) {
            $this->logger->critical($e);
            throw new LocalizedException(
                __('Could not move file from temporary directory to permanent directory.')
            );
        }

        return $imageName;
    }

    public function getFilePath($path, $imageName)
    {
        return rtrim($path, '/') . '/' . ltrim($imageName, '/');
    }

    public function getMediaUrl($imageName)
    {
        return $this->storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA) . self::BASE_PATH . '/' . $imageName;
    }
}
