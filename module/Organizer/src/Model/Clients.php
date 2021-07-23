<?php

namespace Organizer\Model;

use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Filter\ToInt;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\StringLength;

class Clients implements InputFilterAwareInterface
{
  public $name;
  public $email;
  public $eventId;
  
  private $inputFilter;
  
  public function exchangeArray(array $data)
  {
    $this->name = !empty($data['name']) ? $data['name'] : null;
    $this->email  = !empty($data['email']) ? $data['email'] : null;
    $this->eventId = !empty($data['event_id']) ? $data['event_id'] : null;
  }
  
  public function setInputFilter(InputFilterInterface $inputFilter)
  {
    throw new DomainException(sprintf(
      '%s does not allow injection of an alternate input filter',
      __CLASS__
    ));
  }
  
  public function getInputFilter()
  {
    if ($this->inputFilter) {
      return $this->inputFilter;
    }
    
    $inputFilter = new InputFilter();
    
    $inputFilter->add([
      'name' => 'event_id',
      'required' => true,
      'filters' => [
        ['name' => ToInt::class],
      ],
    ]);
    
    $inputFilter->add([
      'name' => 'name',
      'required' => true,
      'filters' => [
        ['name' => StripTags::class],
        ['name' => StringTrim::class],
      ],
      'validators' => [
        [
          'name' => StringLength::class,
          'options' => [
            'encoding' => 'UTF-8',
            'min' => 1,
            'max' => 50,
          ],
        ],
      ],
    ]);
    
    $inputFilter->add([
      'name' => 'email',
      'required' => true,
      'filters' => [
        ['name' => StripTags::class],
        ['name' => StringTrim::class],
      ],
      'validators' => [
        [
          'name' => StringLength::class,
          'options' => [
            'encoding' => 'UTF-8',
            'min' => 1,
            'max' => 50,
          ],
        ],
      ],
    ]);
    
    $this->inputFilter = $inputFilter;
    
    return $this->inputFilter;
  }
}
