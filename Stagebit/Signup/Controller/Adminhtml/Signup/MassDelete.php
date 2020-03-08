<?php

namespace Stagebit\Signup\Controller\Adminhtml\Signup;

use Stagebit\Signup\Controller\Adminhtml\Signup;


class MassDelete extends Signup
{

    public function execute()
    {
        $registerIds = $this->getRequest()->getParam('regi_id');

        $registerIds = explode(',', $registerIds);

        if (!is_array($registerIds) || empty($registerIds)) {
            $this->messageManager->addError(__('Please select customer(s).'));
        } else {
            $model = $this->_objectManager->create('Stagebit\Signup\Model\Signup');
            try {
                foreach ($registerIds as $id) {
                    $model->load($id);
                    $model->delete();
                }
                $this->messageManager->addSuccess(__('A total of %1 record(s) have been deleted.', count($registerIds)));
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }
        }

        $resultRedirect = $this->resultRedirectFactory->create();

        return $resultRedirect->setPath('*/*/');
    }
}
