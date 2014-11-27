<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ElasticsearchController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel(
            array(
                'statistics' => $this->getServiceLocator()
                            ->get('application.service.elasticsearch')
                            ->getStats()
            )
        );
    }
}
