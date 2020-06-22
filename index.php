<?php

use Cheetah\Config\Config;
use Cheetah\Config\ConfigFactory;
use Cheetah\Config\ConfigInterface;
use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;

ini_set('display_errors', 'on');
ini_set('display_startup_errors', 'on');
error_reporting(E_ALL);

! defined('BASE_PATH') && define('BASE_PATH', __DIR__);
! defined('SWOOLE_HOOK_FLAGS') && define('SWOOLE_HOOK_FLAGS', SWOOLE_HOOK_ALL);

// phpinfo();die();
// $username = "kelezyb";
// $passwd = '123';
// $res = ssh2_connect("127.0.0.1");
// ssh2_auth_password($res,$username,$passwd);

// $stream = ssh2_exec($res,"php -i");//this would execute all the //commands and return

// stream_set_blocking($stream, true);
// while($o = fgets($stream)){
//     echo $o.'<br>';
// }
// ssh2_close($res);

/**
 * Class Mailer
 */
class Mailer
{
    public function __construct()
    {
        echo 'Mailer construct';
    }

    public function mail($recipient, $content)
    {
        echo sprintf("%s to send %s\n", $recipient, $content);
    }
}


/**
 * Class Mailer
 */
class UserManager
{
    private $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
        echo 'UserManager construct';
    }

    public function register($email, $password='')
    {
        // The user just registered, we create his account
        // ...

        // We send him an email to say hello!
        $this->mailer->mail($email, 'Hello and welcome!');
    }
}
include 'vendor/autoload.php';

$builder = new ContainerBuilder();
$builder->useAutowiring(true);
$builder->useAnnotations(true);
//$builder->enableCompilation(BASE_PATH . '/runtime/compilation_cache');
//$builder->writeProxiesToFile(true, BASE_PATH . '/runtime/proxies_cache');
$builder->ignorePhpDocErrors(true);
$builder->addDefinitions(require(BASE_PATH . '/configs/definitions.php'));
try {
    $container = $builder->build();
//    var_dump($container);
    $userManager = $container->get('UserManager');
    $userManager->register("eicesoft@126.com");
//    $config_factory = new ConfigFactory();
//    $configs = $config_factory($container);
    $configs = $container->get(ConfigInterface::class);
//    var_dump($configs);
} catch (Exception $e) {
    var_dump($e);
}
