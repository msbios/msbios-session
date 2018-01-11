<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Session\Initializer;

use Interop\Container\ContainerInterface;
use MSBios\Session\SessionManagerAwareInterface;
use Zend\ServiceManager\Initializer\InitializerInterface;
use Zend\Session\SessionManager;

/**
 * Class SessionManagerInitializer
 * @package MSBios\Session\Initializer
 */
class SessionManagerInitializer implements InitializerInterface
{
    /**
     * @param ContainerInterface $container
     * @param object $instance
     */
    public function __invoke(ContainerInterface $container, $instance)
    {
        if ($instance instanceof SessionManagerAwareInterface) {
            $instance->setSessionManager(
                $container->get(SessionManager::class)
            );
        }

    }
}