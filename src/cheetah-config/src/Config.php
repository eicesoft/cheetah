<?php
declare(strict_types=1);
namespace Cheetah\Config;


class Config implements ConfigInterface
{
    private $config;
    public function __construct($config)
    {
        $this->config = $config;
    }

    public function get(string $key, $default = null)
    {
        // TODO: Implement get() method.
    }

    public function has(string $keys)
    {
        // TODO: Implement has() method.
    }

    public function set(string $key, $value)
    {
        // TODO: Implement set() method.
    }
}