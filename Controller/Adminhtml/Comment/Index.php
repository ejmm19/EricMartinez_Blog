<?php
declare(strict_types=1);

namespace EricMartinez\Blog\Controller\Adminhtml\Comment;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    private $resultPageFactory;

    public function __construct(
        Action\Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('EricMartinez_Blog::comment');
        $resultPage->getConfig()->getTitle()->prepend(__('Comments'));
        return $resultPage;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('EricMartinez_Blog::comment');
    }
}
