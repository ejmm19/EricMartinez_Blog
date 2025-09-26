<?php
namespace EricMartinez\Blog\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;
use EricMartinez\Blog\Model\ImageUploader;

class ImageThumbnail extends Column
{
    protected $urlBuilder;
    protected $imageUploader;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $componentFactory,
        UrlInterface $urlBuilder,
        ImageUploader $imageUploader,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->imageUploader = $imageUploader;
        parent::__construct($context, $componentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $fieldName = $this->getData('name');
            foreach ($dataSource['data']['items'] as & $item) {
                if (isset($item['cover_image'])) {
                    $imageUrl = $this->imageUploader->getMediaUrl($item['cover_image']);
                    $item[$fieldName . '_src'] = $imageUrl;
                    $item[$fieldName . '_alt'] = $item['title'];
                    $item[$fieldName . '_link'] = $this->urlBuilder->getUrl(
                        'ericmartinez_blog/post/edit',
                        ['post_id' => $item['post_id']]
                    );
                    $item[$fieldName . '_orig_src'] = $imageUrl;
                }
            }
        }

        return $dataSource;
    }
}
