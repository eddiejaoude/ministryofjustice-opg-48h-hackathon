<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class DatabaseController extends AbstractActionController
{
    public function indexAction()
    {
        $statistics = $this->getServiceLocator()
            ->get('application.service.database')
            ->getStats();

        return new ViewModel(
            array(
                'statistics' => $statistics,
                'pieTotal' => $this->getServiceLocator()
                    ->get('application.service.database')
                    ->getStatsForPieGraph($statistics, 'total'),
                'pieSize' => $this->getServiceLocator()
                    ->get('application.service.database')
                    ->getStatsForPieGraph($statistics, 'size'),
            )
        );
    }
}
