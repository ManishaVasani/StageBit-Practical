<?php

namespace Stagebit\Signup\Block\Adminhtml\Signup\Edit;

class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    protected function _construct()
    {
        parent::_construct();
        $this->setId('signup');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Customer Information'));
    }
}
