<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Session\Initializer;


use Interop\Container\ContainerInterface;
use MSBios\Session\ContainerAwareInterface;
use Zend\ServiceManager\Initializer\InitializerInterface;

/**
 * Class ContainerInitializer
 * @package MSBios\Session\Initializer
 */
class ContainerInitializer implements InitializerInterface
{
    /**
     * @param ContainerInterface $container
     * @param object $instance
     */
    public function __invoke(ContainerInterface $container, $instance)
    {
        if ($instance instanceof ContainerAwareInterface) {
            $instance->setContainer(
                $container->get(\MSBios\Session\ContainerInterface::class)
            );
        }

    }
}