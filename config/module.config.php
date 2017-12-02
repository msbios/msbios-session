<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Session;

use \Zend\Session;

return [

    'service_manager' => [
        'factories' => [
            Module::class =>
                Factory\ModuleFactory::class,
            Session\SessionManager::class =>
                Factory\SessionManagerFactory::class
        ]
    ],

    Module::class => [
        Session\SessionManager::class => [
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
        ]
    ]
];
