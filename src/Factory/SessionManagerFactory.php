<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Session\Factory;

use Interop\Container\ContainerInterface;
use MSBios\Session\Module;
use Zend\Session\Container;
use Zend\Session\ManagerInterface;
use Zend\Session\Service\SessionManagerFactory as DefaultSessionManager;
use Zend\Session\SessionManager;

/**
 * Class SessionManagerFactory
 * @package MSBios\Session\Factory
 */
class SessionManagerFactory extends DefaultSessionManager
{
    /**
     * @inheritdoc
     *
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return ManagerInterface|SessionManager
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var ManagerInterface $sessionManager */
        $sessionManager = parent::__invoke($container, $requestedName, $options);

        /** @var array $defaultOptions */
        $defaultOptions = $container->build(Module::class, $options);

        if ($container->has($defaultOptions['save_handler'])) {
            $sessionManager->setSaveHandler(
                $container->get($defaultOptions['save_handler'])
            );
        }

        Container::setDefaultManager($sessionManager);
        return $sessionManager;
    }
}
