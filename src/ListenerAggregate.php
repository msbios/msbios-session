<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Session;

use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\Http\PhpEnvironment\Request;
use Zend\Mvc\MvcEvent;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Session\Container;
use Zend\Session\ManagerInterface;
use Zend\Session\Validator\HttpUserAgent;
use Zend\Session\Validator\RemoteAddr;
use Zend\Stdlib\ParametersInterface;

/**
 * Class ListenerAggregate
 * @package MSBios\Session
 */
class ListenerAggregate extends AbstractListenerAggregate
{
    /**
     * @inheritdoc
     *
     * @param EventManagerInterface $events
     * @param int $priority
     */
    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events
            ->attach(MvcEvent::EVENT_BOOTSTRAP, [$this, 'onBootstrap'], $priority);
    }

    /**
     * @param EventInterface $event
     */
    public function onBootstrap(EventInterface $event)
    {
        /** @var ServiceLocatorInterface $serviceManager */
        $serviceManager = $event->getApplication()
            ->getServiceManager();

        /** @var ManagerInterface $sessionManager */
        $sessionManager = $serviceManager->get(SessionManagerInterface::class);
        $sessionManager->start();

        /** @var Container $container */
        $container = new Container(self::class);

        if (isset($container->init)) {
            return;
        }

        /** @var Request $request */
        $request = $serviceManager
            ->get('Request');

        if (! $request instanceof Request) {
            return;
        }

        /** @var ParametersInterface $server */
        $server = $request->getServer();

        $sessionManager->regenerateId(true);
        $container->init = true;
        $container->remoteAddr = $server->get('REMOTE_ADDR');
        $container->httpUserAgent = $server->get('HTTP_USER_AGENT');

        /** @var array $config */
        $config = $serviceManager->get('config');
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
