<?php

namespace Stagebit\Signup\Block\Adminhtml;

class Signup extends \Magento\Backend\Block\Widget\Grid\Container
{

    protected function _construct()
    {
        $this->_controller = 'adminhtml_signup';
        $this->_blockGroup = 'Stagebit_Signup';
        $this->_headerText = __('Customers');
        $this->_addButtonLabel = __('Add New Customer');
        parent::_construct();
    }
}
