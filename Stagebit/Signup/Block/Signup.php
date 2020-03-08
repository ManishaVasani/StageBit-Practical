<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Stagebit\Signup\Block;

use Magento\Framework\View\Element\Template;

/**
 * Main contact form block
 */
class Signup extends Template
{
    /**
     * @param Template\Context $context
     * @param array $data
     */
    protected $_signupFactory;
    protected $_storeManager;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Stagebit\Signup\Model\SignupFactory $signupFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        array $data = []
     ) 
    {
        $this->_signupFactory = $signupFactory;
        $this->_storeManager = $storeManager;
        parent::__construct($context, $data);
        //get collection of data 
        $collection = $this->_signupFactory->create()->getCollection();
        $this->setCollection($collection);
        $this->pageConfig->getTitle()->set(__('Customer signup'));
    }

    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        if ($this->getCollection()) {
            // create pager block for collection 
            $pager = $this->getLayout()->createBlock(
                'Magento\Theme\Block\Html\Pager',
                'stagebit.signup.record.pager'
            )->setCollection(
                $this->getCollection() // assign collection to pager
            );
            $this->setChild('pager', $pager);// set pager block in layout
        }
        return $this;
    }
  
    /**
     * @return string
     */
    // method for get pager html
    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    } 

    /*form action to submit data*/

    public function geActionUrl()
    {
        return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_LINK).'signup/index/submit';
    }
}
