<?php
/**
 * Stagebit
 * Stagebit Signup Form
 *
 * @category   Stagebit
 * @package    Stagebit_Signup
 * @copyright  Copyright © 2020 Stagebit 
 */

namespace Stagebit\Signup\Controller\Index;

use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Framework\App\Area;
use Magento\Framework\Controller\ResultFactory; 

class Submit extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $_scopeConfig;
    
    /**
     * @var \Stagebit\Signup\Helper\Data
     */
    protected $_helper;
    
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;
    
    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Stagebit\Signup\Helper\Data $helper,
        \Stagebit\Signup\Model\SignupFactory $signupFactory,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezoneInterface,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\Framework\App\Response\RedirectInterface $redirect
    ) {
        parent::__construct($context);
        $this->_scopeConfig = $scopeConfig;
        $this->_helper = $helper;
        $this->_storeManager = $storeManager;
        $this->signupFactory = $signupFactory;
        $this->timezoneInterface = $timezoneInterface;
        $this->filesystem = $filesystem;
        $this->redirect = $redirect;
    }

    public function execute()
    {
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
                $model->save();
                $this->messageManager->addSuccess(__('Signup request has been received. We\'ll respond to you very soon.'));
                $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

                $resultRedirect->setUrl($this->_redirect->getRefererUrl());
                return $resultRedirect;
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while register the customer.'));
            }
        } else {
            $this->messageManager->addSuccess(__('Please fill the form.'));
        }
        
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        return $resultRedirect;
    }
}
