<?php
declare(strict_types=1);

namespace EricMartinez\Blog\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;

class CommentActions extends Column
{
    private $urlBuilder;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $componentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $componentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $name = $this->getData('name');
                if (isset($item['comment_id'])) {
                    $item[$name]['approve'] = [
                        'href' => $this->urlBuilder->getUrl('blog/comment/approve', ['id' => $item['comment_id']]),
                        'label' => __('Approve')
                    ];
                    $item[$name]['reject'] = [
                        'href' => $this->urlBuilder->getUrl('blog/comment/reject', ['id' => $item['comment_id']]),
                        'label' => __('Reject')
                    ];
                    $item[$name]['delete'] = [
                        'href' => $this->urlBuilder->getUrl('blog/comment/delete', ['id' => $item['comment_id']]),
                        'label' => __('Delete'),
                        'confirm' => [
                            'title' => __('Delete'),
                            'message' => __('Are you sure you want to delete this comment?')
                        ]
                    ];
                }
            }
        }

        return $dataSource;
    }
}
