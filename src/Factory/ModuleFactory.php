<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Session\Factory;

use Interop\Container\ContainerInterface;
use MSBios\Session\Module;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class ModuleFactory
 * @package MSBios\Session\Factory
 */
class ModuleFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return mixed
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return $container->get('config')[Module::class];
    }
}
