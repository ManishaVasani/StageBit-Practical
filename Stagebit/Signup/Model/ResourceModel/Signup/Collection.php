<?php

namespace Stagebit\Signup\Model\ResourceModel\Signup;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Stagebit\Signup\Model\Signup', 'Stagebit\Signup\Model\ResourceModel\Signup');
    }
}
