<?php

namespace Stagebit\Signup\Controller\Adminhtml\Signup;

class Index extends \Stagebit\Signup\Controller\Adminhtml\Signup
{
    public function execute()
    {
        if ($this->getRequest()->getQuery('ajax')) {
            $resultForward = $this->_resultForwardFactory->create();
            $resultForward->forward('grid');
            return $resultForward;
        }
        $resultPage = $this->_resultPageFactory->create();
        return $resultPage;
    }
}
