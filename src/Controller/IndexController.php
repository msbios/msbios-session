<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Session\Controller;

use MSBios\Application\Controller\IndexController as DefaultIndexController;
use MSBios\Session\ContainerAwareInterface;
use MSBios\Session\ContainerAwareTrait;
use MSBios\Session\Module;
use Zend\Session\Container;

/**
 * Class IndexController
 * @package MSBios\Session\Controller
 */
class IndexController extends DefaultIndexController implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    /**
     * @return \Zend\View\Model\ViewModel
     */
    public function indexAction()
    {
        /** @var Container $container */
        $container = $this->getContainer();
        $container->item = 'foo';

        return parent::indexAction();
    }
}
