<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Session;

use Zend\Session\Container;

/**
 * Interface ContainerAwareInterface
 * @package MSBios\Session
 */
interface ContainerAwareInterface
{
    /**
     * @return Container
     */
    public function getContainer(): Container;

    /**
     * @param Container $container
     * @return $this
     */
    public function setContainer(Container $container);
}