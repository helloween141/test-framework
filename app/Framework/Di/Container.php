<?php

namespace App\Framework\Di;

use DI\ContainerBuilder;
use Exception;

class Container
{
    /**
     * @throws Exception
     */
    public function create()
    {
        $builder = new ContainerBuilder();
        $builder->useAutowiring(false);
        $builder->useAttributes(false);
        $builder->addDefinitions($this->getDefinitions());
        return $builder->build();
    }

    private static function getDefinitions(): array
    {
        $files = array_merge(
            glob(dirname(__DIR__, 3) . '/config/dependencies/*.php' ?: [])
        );

        $config = array_map(function($file) {
            return require $file;
        }, $files);

        return array_merge_recursive(...$config);
    }
}