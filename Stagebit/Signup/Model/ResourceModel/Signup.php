<?php

namespace Stagebit\Signup\Model\ResourceModel;

class Signup extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('mkv_signup_form', 'regi_id');
    }
}
