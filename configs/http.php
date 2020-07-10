<?php
return [
    'host' => '0.0.0.0',
    'port' => 10220,

    'params' => [
        'document_root' => BASE_PATH . DIRECTORY_SEPARATOR . 'public',
        'enable_static_handler' => true,
        'pid_file' => BASE_PATH . '/runtime/cheetah.pid',
        'http_index_files' => ['index.html', 'index.htm'],
        'dispatch_mode' => 2,
        'max_request' => 200000,
        'worker_num' => 2,
        'task_worker_num' => 0,
        'task_max_request' => 500,
        'reactor_num' => 2,
        'daemonize' => false,
        'reload_async' => true,
        'backlog' => 128,
        'open_cpu_affinity' => true,
//        'user' => 'nginx',
        'tcp_fastopen' => true,
        'heartbeat_idle_time' => 300,
        'heartbeat_check_interval' => 120,
    ]
];