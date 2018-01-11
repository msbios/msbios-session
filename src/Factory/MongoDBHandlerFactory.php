<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Session\Factory;

use Interop\Container\ContainerInterface;
use MongoDB\Client;
use MSBios\Session\Module;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Session\SaveHandler\MongoDB;
use Zend\Session\SaveHandler\MongoDBOptions;

/**
 * Class MongoDBHandlerFactory
 * @package MSBios\Session\Factory
 */
class MongoDBHandlerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return MongoDB
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {

        echo __METHOD__; die();

        /** @var array $options */
        $options = $container->get(Module::class);

        return new MongoDB(
            $container->get(Client::class),
            new MongoDBOptions($options[MongoDBOptions::class])
        );
    }
}
