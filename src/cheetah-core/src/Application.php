<?php
namespace Cheetah;

use Cheetah\Server\HttpServer;
use Cheetah\Server\ServerInterface;
use DI\Container;
use Psr\Container\ContainerInterface;

/**
 * Class Application
 * @package Cheetah
 * @author kelezyb
 */
class Application
{
    /**
     * @var ContainerInterface
     */
    private static $container;

    public static function getContainer(): ContainerInterface
    {
        return self::$container;
    }

    private $server;

    /**
     * Application constructor.
     * @param ContainerInterface $container
     * @param ServerInterface $server
     */
    public function __construct(ContainerInterface $container, ServerInterface $server)
    {
        self::$container = $container;
        $this->server = $server;
    }

    public function run()
    {
        $this->server->start();
    }
}