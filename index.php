<?php

use Cheetah\Application;
use Cheetah\Di\ContainerUtil;

ini_set("memory_limit", "128M");
ini_set('display_errors', 'on');
ini_set('display_startup_errors', 'on');
error_reporting(E_ALL);

! defined('BASE_PATH') && define('BASE_PATH', __DIR__);
! defined('SWOOLE_HOOK_FLAGS') && define('SWOOLE_HOOK_FLAGS', SWOOLE_HOOK_ALL);

include 'vendor/autoload.php';

try {
//    $container = ContainerUtil::create();
    $container = \Cheetah\Di\Container::getInstance();
    $application = $container->get(Application::class);
    $application->run();
} catch (Exception $e) {
    var_dump($e);
}
