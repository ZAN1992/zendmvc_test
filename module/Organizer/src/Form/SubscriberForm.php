<?php

namespace Organizer\Form;

use Zend\Form\Form;

class SubscriberForm extends Form
{
  public function __construct($name = null)
  {
    parent::__construct('subscriber');
    
    $this->add([
      'name' => 'event_id',
      'type' => 'hidden',
    ]);
    $this->add([
      'name' => 'name',
      'type' => 'text',
      'options' => [
        'label' => 'Name',
      ],
    ]);
    $this->add([
      'name' => 'email',
      'type' => 'text',
      'options' => [
        'label' => 'Email',
      ],
    ]);
    $this->add([
      'name' => 'submit',
      'type' => 'submit',
      'attributes' => [
        'value' => 'Subscribe!',
        'id'    => 'submitbutton',
      ],
    ]);
  }
}
