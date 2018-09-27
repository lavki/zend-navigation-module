<?php

namespace Navigation;

use Zend\Router\Http\Segment;
use Navigation\Controller\IndexController;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

return [
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => Controller\Factory\IndexControllerFactory::class,
        ],
    ],

    'service_manager' => [
        'factories' => [
            Service\NavigationManager::class => Service\Factory\NavigationManagerFactory::class,
        ],
    ],

    'router' => [
        'routes' => [
            'navigation' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/navigation[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-z]*',
                        'id'     => '[\d]+',
                    ],
                    'defaults' => [
                        'controller' => IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],

    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],

    'doctrine' => [
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/Entity']
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ]
            ]
        ]
    ]
];
