<?php

namespace Organizer\Model;

use Zend\Db\TableGateway\TableGatewayInterface;

class EventsTable
{
  private $tableGateway;
  
  public function __construct(TableGatewayInterface $tableGateway)
  {
    $this->tableGateway = $tableGateway;
  }
  
  public function getAll()
  {
    return $this->tableGateway->select();
  }
}
