<?php
namespace Stagebit\Signup\Controller\Adminhtml\Signup;

use Stagebit\Signup\Controller\Adminhtml\Signup;

class Delete extends Signup
{
    /**
     * Delete action.
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /*delete record*/
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('regi_id');
        if ($id) {
            try {
                $model = $this->_objectManager->create('Stagebit\Signup\Model\Signup');
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccess(__('You deleted the customer.'));

                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }
        $this->messageManager->addError(__('We can\'t find a customer record.'));

        return $resultRedirect->setPath('*/*/');
    }
}
