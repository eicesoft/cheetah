<?php
use DI\ContainerBuilder;

ini_set('display_errors', 'on');
ini_set('display_startup_errors', 'on');
error_reporting(E_ALL);

! defined('BASE_PATH') && define('BASE_PATH', dirname(__DIR__, 1));
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

class Mailer
{
    public function mail($recipient, $content)
    {
        echo sprintf("%s to send %s", $recipient, $content);
    }
}

class UserManager
{
    private $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
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
$builder->useAnnotations(false);
$builder->ignorePhpDocErrors(true);
try {
    $container = $builder->build();
//    var_dump($container);
    $userManager = $container->get('UserManager');
    var_dump($container);
    $userManager->register("eicesoft@126.com");
} catch (Exception $e) {
    var_dump($e);
}
