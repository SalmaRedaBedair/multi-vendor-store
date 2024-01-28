<?php
include __DIR__.'/autoload.php';

use A\B\Person;

$person = new Person();
$person->name='Eman Emad';
ServiceContainer::bind('person', $person);

echo Facade::name('Sandy','Khalid');

echo Facade::name();
