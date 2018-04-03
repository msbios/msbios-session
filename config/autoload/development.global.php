<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Session;

use MSBios\Session\Initializer\ContainerInitializer;
use MSBios\Session\Initializer\SessionManagerInitializer;
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

    \MSBios\MongoDB\Module::class => [

        \MongoDB\Client::class => [
            /**
             *
             * Expects: string
             * Default: mongodb://127.0.0.1/
             */
            'uri' => 'mongodb://demo.gns-it.com/',

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

    Module::class => [

        /**
         *
         * Expects: string
         * Default: Zend\Session\Session\SaveHandler\SaveHandlerInterface
         * Examples: [
         *     MSBios\Session\SaveHandler\MongoDB::class
         * ]
         */
        'save_handler' => MongoDB::class,

        /**
         *
         * Expects: array
         */
        'handlers' => [
            MongoDB::class => [
                'database' => 'openpower',
                'collection' => md5(__NAMESPACE__)
            ],
            // ... and more handlers in future
        ]

    ]
];
