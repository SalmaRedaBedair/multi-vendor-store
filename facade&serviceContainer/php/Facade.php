<?php

class Facade {
    protected static $container = 'person';

    public static function __callStatic($method, $args)
    {
        $sc=new ServiceContainer();
        $person=$sc->make(self::$container);
        return $person->$method(...$args);
    }
}


