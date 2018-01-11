<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Session\Controller;

use MSBios\Application\Controller\IndexController as DefaultIndexController;
use MSBios\Session\ContainerAwareInterface;
use MSBios\Session\ContainerAwareTrait;
use MSBios\Session\SessionManagerAwareInterface;
use MSBios\Session\SessionManagerAwareTrait;
use Zend\Session\Container;
use Zend\View\Model\ViewModel;

/**
 * Class IndexController
 * @package MSBios\Session\Controller
 */
class IndexController extends DefaultIndexController implements
    ContainerAwareInterface,
    SessionManagerAwareInterface
{
    use ContainerAwareTrait;
    use SessionManagerAwareTrait;

    /**
     * @return \Zend\View\Model\ViewModel
     */
    public function indexAction()
    {

        // r($this->getSessionManager()); die();

        /** @var Container $container */
        $container = $this->getContainer();
        $container->foo = 'bar';
        $container->now = time();

        return new ViewModel([
            'container' => $container
        ]);
    }
}
