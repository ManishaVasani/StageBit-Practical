<?php

namespace Stagebit\Signup\Controller\Adminhtml\Signup;


class Save extends \Stagebit\Signup\Controller\Adminhtml\Signup
{

    public function execute()
    {

		$image = null;
        $customerId = '';
        $formPostValues = [];
        $resultRedirect = $this->resultRedirectFactory->create();
        $anyError = 0;

        /*get all form data*/
		$formPostValues['signupData'] = $this->getRequest()->getPostValue();

        if (isset($formPostValues['signupData'])) {
		
            $signupData = $formPostValues['signupData'];
            $customerId = isset($signupData['regi_id']) ? $signupData['regi_id'] : null;
			
            $model = $this->signupFactory->create();
            $model->load($customerId);
            $model->setData($signupData);

		    try {
                /*save data in table*/
                if(!$anyError) {
                    $model->save();
                    $this->messageManager->addSuccess(__('The customer has been saved.'));
                    $this->_getSession()->setFormData(false);
                    return $this->_getBackResultRedirect($resultRedirect, $model->getId());
                } else  {
                    $this->messageManager->addSuccess(__('Something went wrong while saving the customer.'));
                    $this->_getSession()->setFormData(false);
                   return $resultRedirect->setPath('*/*/');
                }
               
            } catch (\Exception $e) {
                $anyError = 1;
                $this->messageManager->addError($e->getMessage());
                $this->messageManager->addException($e, __('Something went wrong while saving the customer.'));
            }

            $this->_getSession()->setFormData($formPostValues);

            return $resultRedirect->setPath('*/*/edit', [static::PARAM_CRUD_ID => $customerId]);
        }

        return $resultRedirect->setPath('*/*/');
    }
}
