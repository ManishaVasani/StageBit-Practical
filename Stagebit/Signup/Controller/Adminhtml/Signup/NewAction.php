<?php

namespace Stagebit\Signup\Controller\Adminhtml\Signup;

class NewAction extends \Stagebit\Signup\Controller\Adminhtml\Signup
{
    public function execute()
    {
          $resultForward = $this->_resultForwardFactory->create();
          return $resultForward->forward('edit');
    }
}
