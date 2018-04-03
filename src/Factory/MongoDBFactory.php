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
class MongoDBFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return MongoDB
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var array $config */
        $config = $container->get(Module::class)['handlers'];

        /**
         * Can be override
         */
        if (! is_null($options) && is_array($options)) {
            $config = array_merge($config, $options);
        }

        return new MongoDB(
            $container->get(Client::class),
            new MongoDBOptions($config[MongoDB::class])
        );
    }
}
