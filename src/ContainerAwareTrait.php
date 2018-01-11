<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Session;

use Zend\Session\Container;

/**
 * Trait ContainerAwareTrait
 * @package MSBios\Session
 */
trait ContainerAwareTrait
{
    /** @var Container */
    protected $container;

    /**
     * @return Container
     */
    public function getContainer(): Container
    {
        return $this->container;
    }

    /**
     * @param Container $container
     * @return $this
     */
    public function setContainer(Container $container)
    {
        $this->container = $container;
        return $this;
    }
}