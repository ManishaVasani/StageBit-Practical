<?php
/**
 * Stagebit
 * Stagebit Signup Form
 *
 * @category   Stagebit
 * @package    Stagebit_Signup
 * @copyright  Copyright © 2020 Stagebit 
 * @license    
 */
namespace Stagebit\Signup\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        $this->_storeManager = $storeManager;
        parent::__construct($context);
    }

    /**
     * Get config value
     */
    public function getConfigValue($value = '')
    {
        return $this->scopeConfig
                ->getValue(
                    $value,
                    \Magento\Store\Model\ScopeInterface::SCOPE_STORE
                );
    }


    /**
     * Check module is enabled
     */
    public function isModuleEnable()
    {
        return  $this->scopeConfig->getValue('signup_form/general/enable',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE);  
    }
}
