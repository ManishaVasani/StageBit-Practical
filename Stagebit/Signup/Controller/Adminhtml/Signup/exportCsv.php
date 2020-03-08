<?php

namespace Stagebit\Signup\Controller\Adminhtml\Signup;
use \Magento\Framework\Filesystem\DirectoryList;

class ExportCsv extends \Magento\Backend\App\Action
{   
    /**
     * Default file name
     */
    const FILENAME = 'customer-signup.csv';
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
            ->getCsv();

        return $this->_fileFactory->create(
            $fileName,
            $content/*,
            DirectoryList::PATH*/
        );
    }
}