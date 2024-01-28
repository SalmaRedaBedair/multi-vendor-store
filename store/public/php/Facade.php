<?php

class Facade
{
    protected static $container='person';

    public static function __callStatic($method, $args)
    {
        $person=ServiceContainer::make(self::$container);
        return $person->$method(...$args);
    }
}
