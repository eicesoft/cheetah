<?php
use Cheetah\Config\ConfigFactory;
use Cheetah\Config\ConfigInterface;
use Cheetah\Server\ServerInterface;
use Psr\Container\ContainerInterface;
use function DI\factory;

return [
    ConfigInterface::class => factory(
        function (ContainerInterface $c) {
            $config_factory = $c->get(ConfigFactory::class);
            return $config_factory($c);
        }
    ),
    ServerInterface::class => factory(
        function (ContainerInterface $container) {
            return $container->get(\Cheetah\Server\HttpServer::class);
        }
    )
];