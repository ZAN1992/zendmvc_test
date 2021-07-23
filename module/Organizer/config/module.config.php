<?php

namespace Organizer;

use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
  'router' => [
    'routes' => [
      'organizer' => [
        'type'    => Segment::class,
        'options' => [
          'route' => '[/:action]/',
          'constraints' => [
            'action' => 'subscribe',
          ],
          'defaults' => [
            'controller' => Controller\IndexController::class,
            'action'     => 'index',
          ],
        ],
      ],
    ],
  ],
  
  'view_manager' => [
    'template_map' => [
      'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
      'organizer/index/index' => __DIR__ . '/../view/organizer/index/index.phtml',
    ],
  //  'template_path_stack' => [
  //    __DIR__ . '/../view',
  //  ],
  ],
];
