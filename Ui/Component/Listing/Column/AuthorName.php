<?php
namespace EricMartinez\Blog\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\User\Model\UserFactory;

class AuthorName extends Column
{
    protected $userFactory;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $componentFactory,
        UserFactory $userFactory,
        array $components = [],
        array $data = []
    ) {
        $this->userFactory = $userFactory;
        parent::__construct($context, $componentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                if (isset($item['admin_user_id'])) {
                    $user = $this->userFactory->create()->load($item['admin_user_id']);
                    if ($user->getId()) {
                        $item[$this->getData('name')] = $user->getFirstName() . ' ' . $user->getLastName();
                    } else {
                        $item[$this->getData('name')] = __('Unknown');
                    }
                }
            }
        }

        return $dataSource;
    }
}
