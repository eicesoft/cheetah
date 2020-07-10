<?php
namespace Cheetah\Server;


use Psr\Container\ContainerInterface;

abstract class Server implements ServerInterface
{
    /**
     * @var \Swoole\Server
     */
    protected $server;

    /**
     * @var string
     */
    protected $host;

    /**
     * @var int
     */
    protected $port;

    protected $name;

    protected $container;

    /**
     * Server constructor.
     * @param ContainerInterface $container
     */
    public function __construct($container)
    {
        $this->name = 'Cheetah';
        $this->container = $container;
    }

    /**
     * Registry service events
     */
    public function registryBaseEvents()
    {
        $this->server->on('Start', [$this, 'onStart']);
        $this->server->on('ManagerStart', [$this, 'onManagerStart']);
        $this->server->on('WorkerStart', [$this, 'onWorkerStart']);
        $this->server->on('WorkerStop', [$this, 'onWorkerStop']);
        $this->server->on('WorkerError', [$this, 'onWorkerError']);
        $this->server->on('Shutdown', [$this, 'onShutdown']);
    }

    abstract function registryEvents();

    /**
     * service start event
     * @param \swoole_server $serv
     */
    public function onStart($serv) {
        swoole_set_process_name($this->name . " master");
    }

    /**
     * manager process start
     * @param \swoole_server $serv
     */
    public function onManagerStart($serv) {
        swoole_set_process_name($this->name . " manager");
    }
    /**
     * worker process start event
     * @param \swoole_server $serv
     * @param int $worker_id
     */
    public function onWorkerStart($serv, $worker_id) {
        $pid = posix_getpid();

        if ($worker_id >= $serv->setting['worker_num']) {
            swoole_set_process_name($this->name . " task_{$worker_id}");
//            Console::info("Lark %s service task worker %s start.", [$this->name, $pid]);
        } else {
            swoole_set_process_name($this->name . " worker_{$worker_id}");
//            Console::info("Lark %s service worker %s start.", [$this->name, $pid]);
        }
    }

    /**
     * worker process stop event
     * @param \swoole_server $serv
     * @param int $worker_id
     */
    public function onWorkerStop($serv, $worker_id) {
//        Console::info("Lark %s service worker %s stop.", [$this->name, $worker_id]);
    }

    /**
     * worker process error event
     * @param \swoole_server $serv
     * @param int $worker_id
     * @param int $worker_pid
     * @param int $exit_code
     * @param int $signal
     */
    public function onWorkerError($serv, $worker_id, $worker_pid, $exit_code, $signal) {
//        Console::warn("Worker_%s - (%s, %s)", [$worker_pid, $exit_code, $signal]);
    }

    /**
     * service shutdown event
     * @param $serv
     */
    public function onShutdown($serv) {
//        Console::info("Lark %s service will shutdown...", [$this->name]);
    }

}