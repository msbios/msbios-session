<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Session;

use MSBios\ModuleInterface;
use Zend\EventManager\EventInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\Loader\AutoloaderFactory;
use Zend\Loader\StandardAutoloader;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Session\Container;
use Zend\Session\ManagerInterface;
use Zend\Session\Validator\HttpUserAgent;
use Zend\Session\Validator\RemoteAddr;
use Zend\Stdlib\ParametersInterface;
use Zend\Stdlib\RequestInterface;

/**
 * Class Module
 * @package MSBios\Application
 */
class Module implements
    ModuleInterface,
    AutoloaderProviderInterface,
    BootstrapListenerInterface
{
    /** @const VERSION */
    const VERSION = '1.0.1';

    /**
     * @return mixed
     */
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    /**
     * Return an array for passing to Zend\Loader\AutoloaderFactory.
     *
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return [
            AutoloaderFactory::STANDARD_AUTOLOADER => [
                StandardAutoloader::LOAD_NS => [
                    __NAMESPACE__ => __DIR__,
                ],
            ],
        ];
    }

    /**
     * Listen to the bootstrap event
     *
     * @param EventInterface $e
     * @return array
     */
    public function onBootstrap(EventInterface $e)
    {
        /** @var EventManagerInterface $eventManager */
        $eventManager = $e->getApplication()
            ->getEventManager();

        /** @var ListenerAggregateInterface $moduleRouteListener */
        $moduleRouteListener = new ModuleRouteListener;
        $moduleRouteListener->attach($eventManager);
        $this->bootstrapSession($e);
    }

    /**
     * @param EventInterface $e
     */
    protected function bootstrapSession(EventInterface $e)
    {
        /** @var ServiceLocatorInterface $serviceManager */
        $serviceManager = $e->getApplication()
            ->getServiceManager();

        /** @var ManagerInterface $sessionManager */
        $sessionManager = $serviceManager->get(SessionManagerInterface::class);
        $sessionManager->start();

        /** @var Container $container */
        $container = new Container('initialized');

        if (isset($container->init)) {
            return;
        }

        /** @var RequestInterface $request */
        $request = $serviceManager->get('Request');

        /** @var ParametersInterface $server */
        $server = $request->getServer();

        $sessionManager->regenerateId(true);
        $container->init = 1;
        $container->remoteAddr = $server->get('REMOTE_ADDR');
        $container->httpUserAgent = $server->get('HTTP_USER_AGENT');

        $config = $serviceManager->get('Config');
        if (! isset($config['session_manager'])) {
            return;
        }

        $sessionConfig = $config['session_manager'];

        if (! isset($sessionConfig['validators'])) {
            return;
        }

        $chain = $sessionManager->getValidatorChain();

        foreach ($sessionConfig['validators'] as $validator) {
            switch ($validator) {
                case HttpUserAgent::class:
                    $validator = new $validator($container->httpUserAgent);
                    break;
                case RemoteAddr::class:
                    $validator = new $validator($container->remoteAddr);
                    break;
                default:
                    $validator = new $validator();
            }

            $chain->attach('session.validate', [$validator, 'isValid']);
        }
    }
}
