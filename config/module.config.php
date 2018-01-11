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

            Session\SaveHandler\SaveHandlerInterface::class =>
                Factory\MongoDBHandlerFactory::class
        ]
    ],

    'session_config' => [
        'name' => 'msbios-session'
    ],

    'session_storage' => [
        'type' => Session\Storage\SessionArrayStorage::class,
        'options' => []
    ],

    'session_manager' => [
        'validators' => [
            // Session\Validator\RemoteAddr::class,
            // Session\Validator\HttpUserAgent::class,
        ],
        'options' => []
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
         * Expects: boolean
         * Default: false
         */
        'use_save_handler' => true,

        /**
         *
         */
        Session\SaveHandler\MongoDBOptions::class => [
            'database' => 'some-database-name',
            'collection' => 'some-collection-name',
        ]
    ]
];
