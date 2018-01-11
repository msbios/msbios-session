<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Session;

use Zend\Session\ManagerInterface;

/**
 * Trait SessionManagerAwareTrait
 * @package MSBios\Session
 */
trait SessionManagerAwareTrait
{
    /** @var ManagerInterface */
    protected $sessionManager;

    /**
     * @return ManagerInterface
     */
    public function getSessionManager(): ManagerInterface
    {
        return $this->sessionManager;
    }

    /**
     * @param ManagerInterface $sessionManager
     * @return $this
     */
    public function setSessionManager(ManagerInterface $sessionManager)
    {
        $this->sessionManager = $sessionManager;
        return $this;
    }
}
