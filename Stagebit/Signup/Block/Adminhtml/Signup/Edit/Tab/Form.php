<?php

namespace Stagebit\Signup\Block\Adminhtml\Signup\Edit\Tab;

class Form extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{

    protected $context;

    protected $registry;

    protected $formFactory;

    protected $fieldFactory;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Config\Model\Config\Structure\Element\Dependency\FieldFactory $fieldFactory,
        array $data = []
    ) {
        $this->_fieldFactory = $fieldFactory;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    protected function _prepareLayout()
    {
        $this->getLayout()->getBlock('page.title')->setPageTitle($this->getPageTitle());
    }

    protected function _prepareForm()
    {
        $Customer = $this->getCustomer();
        $isElementDisabled = true;
        $form = $this->_formFactory->create();

        $dependenceBlock = $this->getLayout()->createBlock(
            'Magento\Backend\Block\Widget\Form\Element\Dependence'
        );

        $fieldMaps = [];

        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __( 'Customer Information')]);
        $isChecked = 0;
        if ($Customer) {
            if ($Customer->getId()) {
                $fieldset->addField('regi_id', 'hidden', ['name' => 'regi_id']);        
            }
            if($Customer->getCheckboxBtn()) {
                $isChecked = $Customer->getCheckboxBtn();
            }
        }
            
        /* form fields*/
        $fieldset->addField(
            'c_name',
            'text',
            [
                'name' => 'c_name',
                'label' => __('Name'),
                'title' => __('Name'),
                'required' => true,
                'class' => 'required-entry validate-alphanum-with-spaces validate-no-html-tags',
                'maxlength' => 30
            ]
        );

        $fieldset->addField(
            'c_email',
            'text',
            [
                'name' => 'c_email',
                'label' => __('Email'),
                'title' => __('Email'),
                'required' => true,
                'class' => 'required-entry validate-email',
                'maxlength' => 30
            ]
        );

        $fieldset->addField(
            'c_password',
            'password',
            [
                'name' => 'c_password',
                'label' => __('Password'),
                'title' => __('Password'),
                'required' => true,
                'class' => 'required-entry validate-password',
                'maxlength' => 30
            ]
        );


        $fieldset->addField(
            'c_telephone',
            'text',
            [
                'name' => 'c_telephone',
                'label' => __('Telephone No.'),
                'title' => __('Telephone No.'),
                'required' => true,
                'class' => 'required-entry validate-digits',
                'maxlength' => 30
            ]
        );

        $fieldset->addField(
            'c_bdate',
            'date',
            [
                'name' => 'c_bdate',
                'label' => __('Birth Date'),
                'title' => __('Birth Date'),
                'required' => false,
                'date_format' => 'yyyy-MM-dd',
                'time_format' => 'hh:mm:ss',
                'class' => 'validate-date',
            ]
        ); 
        
        $form->setValues($Customer->getData());
        $this->setForm($form);
        return parent::_prepareForm();
    }


    public function getCustomer()
    {
        return $this->_coreRegistry->registry('signup');
    }

    public function getPageTitle()
    {
        return $this->getCustomer()->getId() ? __("Edit Customer '%1'", $this->escapeHtml($this->getCustomer()->getCName())) : __('New Customer');
    }

    public function getTabLabel()
    {
        return __( 'Customer Information');
    }

    public function getTabTitle()
    {
        return __('Customer Information');
    }

    public function canShowTab()
    {
        return true;
    }

    public function isHidden()
    {
        return false;
    }

}
