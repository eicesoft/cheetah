<?php
namespace Cheetah\Di;


use DI\ContainerBuilder;

class ContainerUtil
{
    /**
     * @return \DI\Container
     * @throws \Exception
     */
    public static function create()
    {
        $builder = new ContainerBuilder();
        $builder->useAutowiring(true);
        $builder->useAnnotations(true);
        $builder->enableCompilation(BASE_PATH . '/runtime/compilation_cache');
        $builder->ignorePhpDocErrors(true);
        $builder->addDefinitions(require( __DIR__ . '/definitions.php'));
        return $builder->build();
    }
}