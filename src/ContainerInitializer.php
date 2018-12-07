<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Session;

use Interop\Container\ContainerInterface as InteropContainerInterface;
use Zend\ServiceManager\Initializer\InitializerInterface;

/**
 * Class ContainerInitializer
 * @package MSBios\Session
 */
class ContainerInitializer implements InitializerInterface
{
    /**
     * @param InteropContainerInterface $container
     * @param object $instance
     */
    public function __invoke(InteropContainerInterface $container, $instance)
    {
        if ($instance instanceof ContainerAwareInterface) {
            $instance->setContainer(
                $container->get(ContainerInterface::class)
            );
        }
    }

    /**
     * @param $an_array
     * @return ContainerInitializer
     */
    public static function __set_state($an_array)
    {
        return new self();
    }
}
