<?php
declare(strict_types=1);

namespace EricMartinez\Blog\Controller\Adminhtml\Post;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    /**
     * @var PageFactory
     */
    protected PageFactory $resultPageFactory;

    /**
     * @param Action\Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Action\Context $context,
        PageFactory $resultPageFactory
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('EricMartinez_Blog::post');
        $resultPage->getConfig()->getTitle()->prepend(__('Blog Posts'));

        return $resultPage;
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('EricMartinez_Blog::post');
    }
}
