<?php
namespace Cheetah\Server;


/**
 * Interface ServerInterface
 * @package Cheetah\ServerInterface
 */
interface ServerInterface
{
    public function start();
    public function onRequest($request, $response);
}