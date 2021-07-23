<?php

namespace Organizer;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
  public function getConfig()
  {
    return include __DIR__ . '/../config/module.config.php';
  }
  
  public function getServiceConfig()
  {
    return [
      'factories' => [
        Model\EventsTable::class => function($container) {
          $tableGateway = $container->get(Model\EventsTableGateway::class);
          return new Model\EventsTable($tableGateway);
        },
        Model\EventsTableGateway::class => function ($container) {
          $dbAdapter = $container->get(AdapterInterface::class);
          $resultSetPrototype = new ResultSet();
          $resultSetPrototype->setArrayObjectPrototype(new Model\Events());
          return new TableGateway('events', $dbAdapter, null, $resultSetPrototype);
        },
  
        Model\ClientsTable::class => function($container) {
          $tableGateway = $container->get(Model\ClientsTableGateway::class);
          return new Model\ClientsTable($tableGateway);
        },
        Model\ClientsTableGateway::class => function ($container) {
          $dbAdapter = $container->get(AdapterInterface::class);
          $resultSetPrototype = new ResultSet();
          $resultSetPrototype->setArrayObjectPrototype(new Model\Clients());
          return new TableGateway('clients', $dbAdapter, null, $resultSetPrototype);
        },
      ],
    ];
  }
  
  public function getControllerConfig()
  {
    return [
      'factories' => [
        Controller\IndexController::class => function($container) {
          return new Controller\IndexController(
            $container->get(Model\EventsTable::class),
            $container->get(Model\ClientsTable::class)
          );
        },
      ],
    ];
  }
}
