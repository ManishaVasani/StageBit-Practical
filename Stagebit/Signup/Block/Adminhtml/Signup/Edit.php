<?php

namespace Stagebit\Signup\Block\Adminhtml\Signup;

class Edit extends \Magento\Backend\Block\Widget\Form\Container
{

    protected $_coreRegistry;

    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }
    protected function _construct()
    {
        $this->_objectId = 'regi_id';
        $this->_blockGroup = 'Stagebit_Signup';
        $this->_controller = 'adminhtml_signup';

        parent::_construct();

        $this->buttonList->update('save', 'label', __('Save Customer'));
		$this->buttonList->remove('delete');
        
        if ($this->getRequest()->getParam('regi_id')) {
            $this->addButton(
                'delete',
                [
                    'label'   => __('Delete Customer'),
                    'class'   => 'delete',
                    'onclick' => 'deleteConfirm(\'' . __(
                            'Are you sure you want to do this customer?'
                        ) . '\', \'' . $this->getDeleteUrl() . '\')',
                ]
            );

            $this->buttonList->add(
                'save_and_continue',
                [
                    'label'          => __('Save and Continue Edit'),
                    'class'          => 'save',
                    'data_attribute' => [
                        'mage-init' => [
                            'button' => ['event' => 'saveAndContinueEdit', 'target' => '#edit_form'],
                        ],
                    ],
                ],
                10
            );

            $this->_formScripts[] = "
				require(['jquery'], function($){
					$(document).ready(function(){
						var input = $('<input class=\"custom-button-submit\" type=\"submit\" hidden=\"true\" />');
						$(edit_form).append(input);
						window.customsaveAndContinueEdit = function (){
							edit_form.action = '" . $this->getSaveAndContinueUrl() . "';
							$('.custom-button-submit').trigger('click');
				        }
					});
				});
			";
        } else {
            $this->buttonList->add(
                'save_and_continue',
                [
                    'label'          => __('Save and Continue Edit'),
                    'class'          => 'save',
                    'data_attribute' => [
                        'mage-init' => [
                            'button' => ['event' => 'saveAndContinueEdit', 'target' => '#edit_form'],
                        ],
                    ],
                ],
                10
            );
        }
    }

    public function getInquiry()
    {
        return $this->_coreRegistry->registry('signup');
    }

}
