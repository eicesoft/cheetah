<?php
declare(strict_types=1);
namespace Cheetah\Config;


use Cheetah\File\Finder;
use Psr\Container\ContainerInterface;

class ConfigFactory
{
    /**
     * @param ContainerInterface $container
     * @return Config
     */
    public function __invoke(ContainerInterface $container)
    {
        $configPath = BASE_PATH . '/configs/';
//        $config = $this->readConfig($configPath . 'config.php');
//        $autoloadConfig = $this->readPaths([BASE_PATH . '/config/autoload']);
        $config = $this->readPaths($configPath);
        $merged = array_merge_recursive( ...$config);
        return new Config($merged);
    }


    private function readConfig(string $configPath): array
    {
        $config = [];
        if (file_exists($configPath) && is_readable($configPath)) {
            $config = require $configPath;
        }
        return is_array($config) ? $config : [];
    }

    /**
     * @param string $paths
     * @return array
     */
    private function readPaths(string $path)
    {
        $configs = [];
        $finder = new Finder($path);
        $files = $finder->scan(Finder::FILTER_FILE);
        foreach ($files as $file) {
            $file_name = basename($file);
            list($module) = explode('.', $file_name, 2);
            $configs[] = [$module => require $file];
        }

        return $configs;
    }
}