<?php
namespace EricMartinez\Blog\Controller\Adminhtml\Post;

use Magento\Backend\App\Action;

class NewAction extends Action
{
    /**
     * @return \Magento\Framework\Controller\Result\Forward
     */
    public function execute()
    {
        return $this->_forward('edit');
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('EricMartinez_Blog::post');
    }
}
