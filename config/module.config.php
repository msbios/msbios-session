<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Session;

use Zend\Session;

return [

    'service_manager' => [
        'factories' => [
            Module::class =>
                Factory\ModuleFactory::class,

            ContainerInterface::class =>
                Factory\ContainerFactory::class,

            SessionManagerInterface::class =>
                Factory\SessionManagerFactory::class,

            Session\SaveHandler\MongoDB::class =>
                Factory\MongoDBFactory::class,

            /** For global Zend SessionManager */
            // Session\SaveHandler\SaveHandlerInterface::class =>
            //     Factory\MongoDBFactory::class
        ]
    ],

    'session_config' => [
        'name' => Module::class,
        'options' => [
        ]
    ],

    'session_storage' => [
        'type' => Session\Storage\SessionArrayStorage::class,
        'options' => []
    ],

    /**
     * Global session manager setting v3
     */
    'session_manager' => [
        'config' => [
            'class' => Session\Config\SessionConfig::class,
            'options' => [
                'name' => Module::class,
            ],
        ],
        'storage' => Session\Storage\SessionArrayStorage::class,
        'validators' => [
            Session\Validator\RemoteAddr::class,
            Session\Validator\HttpUserAgent::class,
        ],
    ],

    Module::class => [

        /**
         *
         * Expects: string
         * Default: \Module\Session\Module
         */
        'default_container_name' => Module::class,

        /**
         *
         * Expects: string
         * Default: Zend\Session\Session\SaveHandler\SaveHandlerInterface
         * Examples: [
         *     MSBios\Session\SaveHandler\MongoDB::class
         * ]
         */
        'save_handler' => Session\SaveHandler\SaveHandlerInterface::class,

        /**
         *
         * Expects: array
         */
        'handlers' => [
            Session\SaveHandler\MongoDB::class => [
                'database' => 'some-database-name',
                'collection' => 'some-collection-name'
            ],
            // ... and more handlers in future
        ]
    ]
];
