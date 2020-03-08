<?php

namespace Stagebit\Signup\Controller\Adminhtml\Signup;
use \Magento\Framework\Filesystem\DirectoryList;

class ExportXml extends \Magento\Backend\App\Action
{   
    /**
     * Default file name
     */
    const FILENAME = 'customer-signup.xml';
    const PATH = 'var/export';


    /**
     * @var Magento\Framework\App\Response\Http\FileFactory
     */
    protected $_fileFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context, 
        \Magento\Framework\App\Response\Http\FileFactory $FileFactory)
    {
        parent::__construct($context);
        $this->_fileFactory = $FileFactory;
    }

    public function execute()
    {
        $this->_view->loadLayout(false);

        $fileName = self::FILENAME;

        $content = $this->_view->getLayout()
            ->createBlock('Stagebit\Signup\Block\Adminhtml\Signup\Grid')
            ->setSaveParametersInSession(true)
            ->getXml();

        return $this->_fileFactory->create(
            $fileName,
            $content/*,
            DirectoryList::PATH*/
        );
    }
}