<?php

namespace Stagebit\Signup\Controller\Adminhtml\Signup;

class Grid extends \Stagebit\Signup\Controller\Adminhtml\Signup
{

    public function execute()
    {
        $resultLayout = $this->_resultLayoutFactory->create();
        return $resultLayout;
    }
}
