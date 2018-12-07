<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Session;

use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\Session\SaveHandler\MongoDB;

return [

    'controllers' => [
        'factories' => [
            Controller\IndexController::class =>
                InvokableFactory::class
        ],
        'aliases' => [
            \MSBios\Application\Controller\IndexController::class =>
                Controller\IndexController::class
        ],
        'initializers' => [
            new ContainerInitializer,
            new SessionManagerInitializer
        ]
    ],

    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../../view/',
        ],
    ],

    \MSBios\Assetic\Module::class => [
        'paths' => [
            __DIR__ . '/../../vendor/msbios/application/themes/default/public',
        ],
    ],

    Module::class => [
        'save_handler' => MongoDB::class,
        'handlers' => [
            MongoDB::class => [
                'database' => 'examples',
                'collection' => md5(__NAMESPACE__)
            ],
        ]

    ]
];
