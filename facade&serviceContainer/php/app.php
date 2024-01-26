<?php

include __DIR__ . '/autoload.php';

$person=new Person();
$person->name='salma';
$sc=new ServiceContainer();

$sc->bind('person',$person);

echo Facade::name();
