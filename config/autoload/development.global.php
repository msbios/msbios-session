<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Session;

use Zend\ServiceManager\Factory\InvokableFactory;

return [
//    'router' => [
//        'routes' => [
//            'home' => [
//                'type' => \Zend\Router\Http\Literal::class,
//                'options' => [
//                    'route' => '/',
//                    'defaults' => [
//                        'controller' => \MSBios\Application\Controller\IndexController::class,
//                        'action' => 'index',
//                    ],
//                ],
//            ],
//            'application' => [
//                'type' => \Zend\Router\Http\Segment::class,
//                'options' => [
//                    'route' => '/application[/:action]',
//                    'defaults' => [
//                        'controller' => \MSBios\Application\Controller\IndexController::class,
//                        'action' => 'index',
//                    ],
//                ],
//            ],
//        ],
//    ],
//
    'controllers' => [
        'factories' => [
            Controller\IndexController::class =>
                InvokableFactory::class
        ],
        'aliases' => [
            \MSBios\Application\Controller\IndexController::class =>
                Controller\IndexController::class
        ]
    ],
    \MSBios\Assetic\Module::class => [
        'paths' => [
            __DIR__ . '/../../vendor/msbios/application/themes/default/public',
        ],
    ],

    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../../view/',
        ],
    ],
];
