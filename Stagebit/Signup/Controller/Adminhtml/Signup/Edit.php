<?php

namespace Stagebit\Signup\Controller\Adminhtml\Signup;

class Edit extends \Stagebit\Signup\Controller\Adminhtml\Signup
{

    public function execute()
    {
        $resultPage = $this->_resultPageFactory->create();
        $id = $this->getRequest()->getParam('regi_id');
        $model = $this->signupFactory->create();

        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This customer no longer exists.'));
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }

        $data = $this->_getSession()->getFormData(true);

        if (!empty($data)) {
            $model->setData($data);
        }

        $this->_coreRegistry->register('signup', $model);

        return $resultPage;
    }
}
