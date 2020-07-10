<?php
declare(strict_types=1);
namespace Cheetah\Config;


use Cheetah\Util\Arr;
use function Cheetah\Util\data_get;

class Config implements ConfigInterface
{
    private $configs;
    public function __construct($configs)
    {
        $this->configs = $configs;
    }

    public function get(string $key, $default = null)
    {
        return data_get($this->configs, $key, $default);
    }

    public function has(string $key)
    {
        return Arr::has($this->configs, $key);
    }

    public function set(string $key, $value)
    {

    }
}