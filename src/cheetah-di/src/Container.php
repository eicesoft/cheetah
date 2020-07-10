<?php
namespace Cheetah\Di;


use Cheetah\TSingleton;
use Psr\Container\ContainerInterface;

class Container implements ContainerInterface
{
    use TSingleton;

    private $objects;

    public function __construct()
    {
        $this->objects = [];
    }

    public function get($id)
    {
        if (!isset($this->objects[$id])) {
            return $this->create($id);
        } else {
            return $this->objects[$id];
        }
    }

    public function has($id)
    {
        return isset($this->objects[$id]);
    }

    private function create($id)
    {
        $reflect_class = ReflectionManager::reflectClass($id);

//        $this->objects[$id] = $reflect_class->

        return $this->objects[$id];
    }
}