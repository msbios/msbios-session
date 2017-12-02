<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Session\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Session\Config\SessionConfig;
use Zend\Session\Container;
use Zend\Session\ManagerInterface;
use Zend\Session\SessionManager;

/**
 * Class SessionManagerFactory
 * @package MSBios\Session\Factory
 */
class SessionManagerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return ManagerInterface|SessionManager
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('config');
        if (!isset($config['session'])) {

            /** @var ManagerInterface $sessionManager */
            $sessionManager = new SessionManager;
            Container::setDefaultManager($sessionManager);
            return $sessionManager;
        }

        /** @var array $session */
        $session = $config['session'];

        /** @var mixed $sessionConfig */
        $sessionConfig = null;

        if (isset($session['config'])) {
            $class = isset($session['config']['class'])
                ? $session['config']['class']
                : SessionConfig::class;

            $options = isset($session['config']['options'])
                ? $session['config']['options']
                : [];

            $sessionConfig = new $class();
            $sessionConfig->setOptions($options);
        }

        /** @var mixed $sessionStorage */
        $sessionStorage = null;

        if (isset($session['storage'])) {
            $class = $session['storage'];
            $sessionStorage = new $class();
        }

        /** @var mixed $sessionSaveHandler */
        $sessionSaveHandler = null;

        if (isset($session['save_handler'])) {
            // class should be fetched from service manager
            // since it will require constructor arguments
            $sessionSaveHandler = $container->get($session['save_handler']);
        }

        /** @var ManagerInterface $sessionManager */
        $sessionManager = new SessionManager(
            $sessionConfig, $sessionStorage, $sessionSaveHandler
        );

        Container::setDefaultManager($sessionManager);
        return $sessionManager;
    }
}