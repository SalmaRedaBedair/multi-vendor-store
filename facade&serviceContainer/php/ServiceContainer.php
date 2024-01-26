<?php
class ServiceContainer{
    protected static $container=[]; // we define it static so all values in ti will be the same over all object form that class

    public function bind($name, $instance)
    {
        self::$container[$name]=$instance;
    }

    public function make($name)
    {
        return self::$container[$name];
    }
}
