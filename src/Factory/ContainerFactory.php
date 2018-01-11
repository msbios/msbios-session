<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Session\Factory;

use Interop\Container\ContainerInterface;
use MSBios\Session\Module;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Session\Container;

/**
 * Class ContainerFactory
 * @package MSBios\Session\Factory
 */
class ContainerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return Container
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var array $options */
        $config = $container->get(Module::class);
        return new Container($config['default_container_name']);
    }
}
