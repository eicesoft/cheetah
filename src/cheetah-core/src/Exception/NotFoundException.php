<?php
namespace Cheetah\Exception;


use Exception;


class NotFoundException extends Exception implements \Psr\Container\NotFoundExceptionInterface
{

}