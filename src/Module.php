<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Session;

use MSBios\ModuleInterface;
use Zend\EventManager\EventInterface;
use Zend\Loader\AutoloaderFactory;
use Zend\Loader\StandardAutoloader;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Session\ManagerInterface;
use Zend\Session\SessionManager;

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
    const VERSION = '1.0.0';

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
        /** @var ServiceLocatorInterface $serviceManager */
        $serviceManager = $e->getApplication()
            ->getServiceManager();

        /** @var ManagerInterface $session */
        $session = $serviceManager->get(SessionManager::class);
        $session->start();

        ///** @var Container $container */
        //$container = new Container('initialized');
        //
        //if (isset($container->init)) {
        //    return;
        //}
        //
        //$request = $serviceManager->get('Request');
        //
        //$session->regenerateId(true);
        //$container->init = 1;
        //$container->remoteAddr = $request->getServer()->get('REMOTE_ADDR');
        //$container->httpUserAgent = $request->getServer()->get('HTTP_USER_AGENT');
        //
        //$config = $serviceManager->get('Config');
        //if (!isset($config['session'])) {
        //    return;
        //}
        //
        //$sessionConfig = $config['session'];
        //
        //if (!isset($sessionConfig['validators'])) {
        //    return;
        //}
        //
        //$chain = $session->getValidatorChain();
        //
        //foreach ($sessionConfig['validators'] as $validator) {
        //    switch ($validator) {
        //        case HttpUserAgent::class:
        //            $validator = new $validator($container->httpUserAgent);
        //            break;
        //        case RemoteAddr::class:
        //            $validator = new $validator($container->remoteAddr);
        //            break;
        //        default:
        //            $validator = new $validator();
        //    }
        //
        //    $chain->attach('session.validate', [$validator, 'isValid']);
        //}
    }
}
