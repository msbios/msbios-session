<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Session\Factory;

use Interop\Container\ContainerInterface;
use MSBios\Session\Module;
use Zend\Session\Config\ConfigInterface;
use Zend\Session\Config\SessionConfig;
use Zend\Session\Container;
use Zend\Session\ManagerInterface;
use Zend\Session\Service\SessionManagerFactory as DefaultSessionManager;
use Zend\Session\SessionManager;

/**
 * Class SessionManagerFactory
 * @package MSBios\Session\Factory
 */
class SessionManagerFactory extends DefaultSessionManager // implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return ManagerInterface|SessionManager
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {

        /** @var ManagerInterface $sessionManager */
        $sessionManager = parent::__invoke($container, $requestedName, $options);

        /** @var array $config */
        $config = $container->get(Module::class);

        /** @var string $saveHandler */
        $saveHandler = $config['save_handler'];

        if ($container->has($saveHandler)) {
            $sessionManager->setSaveHandler(
                $container->get($saveHandler)
            );
        }

        Container::setDefaultManager($sessionManager);
        return $sessionManager;
    }
}
