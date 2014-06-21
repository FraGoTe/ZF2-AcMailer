<?php
namespace AcMailerTest\ServiceManager;

use Zend\ServiceManager\Exception;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class ServiceManagerMock
 * @author Alejandro Celaya Alastrué
 * @link http://www.alejandrocelaya.com
 */
class ServiceManagerMock implements ServiceLocatorInterface
{
    /**
     * @var array()
     */
    private $services;

    public function __construct(array $services = array())
    {
        $this->services = $services;
    }

    /**
     * Retrieve a registered instance
     *
     * @param  string $name
     * @throws Exception\ServiceNotFoundException
     * @return object|array
     */
    public function get($name)
    {
        if (!$this->has($name)) {
            throw new Exception\ServiceNotFoundException(sprintf(
                "Service with name %s not found",
                $name
            ));
        }

        return $this->services[$name];
    }

    /**
     * Check for a registered instance
     *
     * @param  string|array $name
     * @return bool
     */
    public function has($name)
    {
        return array_key_exists($name, $this->services);
    }
}
