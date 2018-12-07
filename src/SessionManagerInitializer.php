<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Session;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Initializer\InitializerInterface;
use Zend\Session\SessionManager;

/**
 * Class SessionManagerInitializer
 * @package MSBios\Session
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

    /**
     * @param $an_array
     * @return SessionManagerInitializer
     */
    public static function __set_state($an_array)
    {
        return new self();
    }
}
