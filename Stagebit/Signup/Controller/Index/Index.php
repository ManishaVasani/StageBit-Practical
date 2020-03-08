<?php
/**
 *
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Stagebit\Signup\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Stagebit\Signup\Helper\Data $helper,
        \Magento\Framework\UrlInterface $url,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->helper = $helper;
        $this->url = $url;
        $this->_resultPageFactory = $resultPageFactory;
    }
    /**
     * Show Signup page
     *
     * @return void
     */
    public function execute()
    {
        /*check module is enable*/
        $isModuleEnable = $this->helper->isModuleEnable();
        if(!$isModuleEnable) {
            /*if module not enable reqirect to 404 page*/
            $norouteUrl = $this->url->getUrl('noroute');
            $this->getResponse()->setRedirect($norouteUrl);
            return;
        }
        $resultPage = $this->_resultPageFactory->create();
        return $resultPage;
    }
}
