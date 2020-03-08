<?php

namespace Stagebit\Signup\Block\Adminhtml\Signup;
use Stagebit\Signup\Model\Enum;

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{

    protected $_imageCollectionFactory;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Stagebit\Signup\Model\ResourceModel\Signup\CollectionFactory $signupCollectionFactory,
        array $data = []
    ) {
        $this->signupCollectionFactory = $signupCollectionFactory;
        parent::__construct($context, $backendHelper, $data);
    }


    protected function _construct()
    {
        parent::_construct();
        $this->setId('signupGrid');
        $this->setDefaultSort('regi_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }


    protected function _prepareCollection()
    {
        $collection = $this->signupCollectionFactory->create();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        /*set field for display in grid*/
        $this->addColumn(
            'regi_id',
            [
                'header' => __('ID'),
                'type' => 'number',
                'index' => 'regi_id',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
            ]
        );

        $this->addColumn(
            'c_name',
            [
                'header' => __('Name'),
                'type' => 'text',
                'index' => 'c_name',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
            ]
        );

        $this->addColumn(
            'c_email',
            [
                'header' => __('Email'),
                'type' => 'text',
                'index' => 'c_email',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
            ]
        );

        $this->addColumn(
            'c_password',
            [
                'header' => __('Password'),
                'type' => 'text',
                'index' => 'c_password',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
            ]
        );

        $this->addColumn(
            'c_telephone',
            [
                'header' => __('Telephone No.'),
                'type' => 'text',
                'index' => 'c_telephone',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
            ]
        );

        $this->addColumn(
            'c_bdate',
            [
                'header' => __('Birth Date'),
                'type' => 'date',
                'index' => 'c_bdate',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
            ]
        );
        
        
        $this->addColumn(
            'created_at',
            [
                'header' => __('Created At'),
                'type' => 'date',
                'index' => 'created_at',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
            ]
        );
        
         $this->addColumn(
            'updated_at',
            [
                'header' => __('Updated At'),
                'type' => 'date',
                'index' => 'updated_at',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
            ]
        );
        
        $this->addColumn(
            'edit',
            [
                'header' => __('Edit'),
                'type' => 'action',
                'getter' => 'getId',
                'actions' => [
                    [
                        'caption' => __('Edit'),
                        'url' => [
                            'base' => '*/*/edit',
                        ],
                        'field' => 'regi_id',
                    ],
                ],
                'filter' => false,
                'sortable' => false,
                'index' => 'stores',
                'header_css_class' => 'col-action',
                'column_css_class' => 'col-action',
            ]
        );

        $this->addExportType($this->getUrl('*/*/exportCsv', ['_current' => true]),__('CSV'));
        $this->addExportType($this->getUrl('*/*/exportXml', ['_current' => true]),__('XML'));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('regi_id');
        $this->getMassactionBlock()->setFormFieldName('regi_id');

        $this->getMassactionBlock()->addItem(
            'delete',
            [
                'label' => __('Delete'),
                'url' => $this->getUrl('*/*/massDelete'),
                'confirm' => __('Are you sure?'),
            ]
        );
        return $this;
    }

    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current' => true));
    }

    public function getRowUrl($row)
    {
        return $this->getUrl(
            '*/*/edit',
            array('regi_id' => $row->getId())
        );
    }
}
