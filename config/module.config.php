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
            Session\SaveHandler\SaveHandlerInterface::class =>
                Factory\MongoDBHandlerFactory::class
        ]
    ],

    'session_config' => [
        'name' => 'openpower'
    ],

    'session_storage' => [
        'type' => Session\Storage\SessionArrayStorage::class,
        'options' => []
    ],

    'session_manager' => [
        'validators' => [
            Session\Validator\RemoteAddr::class,
            Session\Validator\HttpUserAgent::class,
        ],
        'options' => []
    ],

    Module::class => [
//        Session\SessionManager::class => [
////            'config' => [
////                'class' => Session\Config\SessionConfig::class,
////                'options' => [
////                    'name' => Module::class,
////                ],
////            ],
////            'storage' => Session\Storage\SessionArrayStorage::class,
////            'validators' => [
////                Session\Validator\RemoteAddr::class,
////                Session\Validator\HttpUserAgent::class,
////            ],
//        ]
    ]
];
