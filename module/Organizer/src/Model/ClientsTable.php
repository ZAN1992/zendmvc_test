<?php

namespace Organizer\Model;

use Zend\Db\TableGateway\TableGatewayInterface;

class ClientsTable
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
  
  public function subscribe(Clients $client)
  {
    $data = [
      'name' => $client->name,
      'email'  => $client->email,
      'event_id' => $client->eventId
    ];
  
    $this->tableGateway->insert($data);
  }
}
