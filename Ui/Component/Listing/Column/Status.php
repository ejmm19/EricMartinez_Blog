<?php
declare(strict_types=1);

namespace EricMartinez\Blog\Ui\Component\Listing\Column;

use Magento\Framework\Data\OptionSourceInterface;

class Status implements OptionSourceInterface
{
    public function toOptionArray()
    {
        return [
            ['value' => 0, 'label' => __('Pending')],
            ['value' => 1, 'label' => __('Approved')],
            ['value' => 2, 'label' => __('Rejected')]
        ];
    }
}
