<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Session;

use MSBios\Session\Initializer\ContainerInitializer;
use MSBios\Session\Initializer\SessionManagerInitializer;
use Zend\ServiceManager\Factory\InvokableFactory;

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

    \MSBios\MongoDB\Module::class => [

        \MongoDB\Client::class => [
            /**
             *
             * Expects: string
             * Default: mongodb://127.0.0.1/
             */
            'uri' => 'mongodb://127.0.0.1/',

            /**
             *
             * Expects: array
             * Default: []
             */
            'uriOptions' => [
                //...
            ],

            /**
             *
             * Expects: array
             * Default: []
             */
            'driverOptions' => [
                //...
            ]
        ]
    ],
];
