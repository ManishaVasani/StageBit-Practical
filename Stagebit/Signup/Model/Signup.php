<?php

namespace Stagebit\Signup\Model;

class Signup extends \Magento\Framework\Model\AbstractModel
{
   
    protected $_categoryCollection;

    protected $_imageCategoryFactory;

    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Stagebit\Signup\Model\ResourceModel\Signup $resource,
        \Stagebit\Signup\Model\SignupFactory $signupFactory,
        \Stagebit\Signup\Model\ResourceModel\Signup\Collection $resourceCollection
    ) {
        parent::__construct(
            $context,
            $registry,
            $resource,
            $resourceCollection
        );
        $this->signupFactory = $signupFactory;
    }
}
