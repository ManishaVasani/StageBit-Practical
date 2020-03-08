<?php

namespace Stagebit\Signup\Controller\Adminhtml;

abstract class Signup extends \Stagebit\Signup\Controller\Adminhtml\AbstractAction
{
    const PARAM_CRUD_ID = 'regi_id';

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Stagebit_Signup::stagebit_config');
    }
}
