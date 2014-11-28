<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class UserController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel(
            array(
            'assignees' => $this->getServiceLocator()
                            ->get('application.service.user')
                            ->getAssignees()
            )
        );
    }
}
