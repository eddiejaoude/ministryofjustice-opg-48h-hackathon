<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class UserController extends AbstractActionController
{
    public function indexAction()
    {
        $id = $this->getRequest()->getPost('user_id', null);

        if (null != $id) {
            $taskEvents = $this->getServiceLocator()
                ->get('application.service.user')
                ->getTaskEventsForEmail($id);
        } else {
            $taskEvents = array();
        }

        return new ViewModel(
            array(
            'assignees' => $this->getServiceLocator()
                            ->get('application.service.user')
                            ->getAssignees(),
            'taskEvents' => $taskEvents
            )
        );
    }
}
