<?php


namespace Cheetah\Server;


use Cheetah\Config\ConfigInterface;
use Psr\Container\ContainerInterface;
use Swoole\Http\Response;

class HttpServer extends Server
{
    /**
     * HttpServer constructor.
     * @param $container
     */
    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
        $config = $this->container->get(ConfigInterface::class);
        $http_config = $config->get('http');
        $this->host = $http_config['host'];
        $this->port = $http_config['port'];
        $this->server = new \Swoole\Http\Server($this->host, $this->port);
        $this->server->set($http_config['params']);
    }

    function registryEvents()
    {
        $this->registryBaseEvents();
        $this->server->on('Request', [$this, 'onRequest']);
    }

    public function start()
    {
        $this->registryEvents();

        $this->server->start();
    }

    /**
     * @param $request
     * @param Response $response
     */
    public function onRequest($request, $response)
    {
        // TODO: Implement onRequest() method.
        $response->end("ok");
    }
}