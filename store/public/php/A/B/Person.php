<?php

namespace A\B;

class Person
{
    public $name;
    public $age;
    public function __construct()
    {
        $a = new \A\A();
        $a->hello();
    }
    public function name(...$args)
    {
        if(count($args)){
            return implode(' ', $args);
        }

        return $this->name;
    }

    public function age()
    {
        return $this->age;
    }
}
