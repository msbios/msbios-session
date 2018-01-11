<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Session;

use Zend\Session\ManagerInterface;

/**
 * Interface SessionManagerAwareInterface
 * @package MSBios\Session
 */
interface SessionManagerAwareInterface
{
    /**
     * @return ManagerInterface
     */
    public function getSessionManager(): ManagerInterface;

    /**
     * @param ManagerInterface $sessionManager
     * @return $this
     */
    public function setSessionManager(ManagerInterface $sessionManager);
}
