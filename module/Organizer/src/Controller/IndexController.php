<?php

namespace Organizer\Controller;

use Organizer\Form\SubscriberForm;
use Organizer\Model\Clients;
use Organizer\Model\ClientsTable;
use Organizer\Model\EventsTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    private $eventsTable;
    private $clientsTable;
    
    public function __construct(EventsTable $eventsTable, ClientsTable $clientsTable)
    {
      $this->eventsTable = $eventsTable;
      $this->clientsTable = $clientsTable;
    }
    
    public function indexAction()
    {
      return new ViewModel([
        'events' => $this->eventsTable->getAll(),
        'clients' => $this->clientsTable->getAll(),
      ]);
    }
  
    public function subscribeAction()
    {
     
      $form = new SubscriberForm();
      $request = $this->getRequest();
  
      if (! $request->isPost()) {
        return ['form' => $form];
      }

      $clients = new Clients();
      $form->setInputFilter($clients->getInputFilter());
      $form->setData($request->getPost());
  
      if (! $form->isValid()) {
        return ['form' => $form];
      }
  
      $clients->exchangeArray($form->getData());
      $this->clientsTable->subscribe($clients);
      
      return $this->redirect()->toRoute('home');
    }
}
