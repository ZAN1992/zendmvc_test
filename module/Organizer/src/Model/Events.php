<?php

namespace Organizer\Model;

class Events
{
  public $id;
  public $title;
  public $summary;
  public $description;
  public $date;
  
  public function exchangeArray(array $data)
  {
    $this->id     = !empty($data['id']) ? $data['id'] : null;
    $this->title = !empty($data['title']) ? $data['title'] : null;
    $this->summary  = !empty($data['summary']) ? $data['summary'] : null;
    $this->description  = !empty($data['description']) ? $data['description'] : null;
    $this->date  = !empty($data['date']) ? $data['date'] : null;
  }
}
