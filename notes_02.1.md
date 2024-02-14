# intial value for properties in the classes
- i can't put intial value for properties in classes which is vary or given by function, i must use constructor for these
- ex: if i want to add property time = current time 
```php
// i can't make that
class Time{
    public $time= time(); // that will give me error xxxxxxxx
}

// to do that i make constructor, and inside constructor give that intial value
class Time
{
    public $time;

    public function __constructor()
    {
        $this->time = time();
    }
}
```

# self & this
- i can't use `$this` inside static classes so i use self instead

```php
class Person{
    public static $country;
    public static setCountry($country)
    {
        self::$country=$country
    }
}
```
# diffrence between static and constant
- constant can't change its value
- static can only accessed by class not its object, value of static can be changed over the class, if i update static value in one object it will be updated for all objects from that class

```php
// to access them inside class

self::$country=$country; // static property
self::MALE='m'; // constant property

// to access outside class

$person= new person();
Person::$country='palastine';
// or
$person::$country='palastine';

```

# static properity
- static over all class, if it is changes by one object it will be changed for all other objects from that class
```php
$person1= new person();
$person2= new person();
$person1::$country='palastine';
$person2::$country='Egypt';

// now the value of static property $country is Egypt for both objects
// because static property is static over the same class not object 
// we can benefit from it if we make array static for the class and add values to it using objects
```

# call function
- i can call function using its namespace

```php
use function B\hello;
hello();  
```
# PSR-4
- php standard recommendations
- autoload 
- it says that name space must be the folder path and file name must be same as class name

# call back function 
- when i call function by another function

## call back function when it is function inside class
- i pass it using array `[Autoloader::class,'register']`

```php
class AutoLoader{
    public function register($className){
        include __DIR__."/{$className}.php";
    }
}

// if method not static

$a=new Autoloader();
spl_autoload_register([$a,'register']);

class AutoLoader{
    public static function register($className){
        include __DIR__."/{$className}.php";
    }
}

// if method is static i pass class name or class it self not object
spl_autoload_register(['Autoloader','register']);
// or
spl_autoload_register([Autoloader::class,'register']); // better to not write name space of class if exists that will return name of class and its namespace
// that is like i do in routing
```

# closure function
- function passed to another function with no name 

# className::class
- that will return class name and namespace like that `app/http/controller/StoreController`

# overload is not allowed in php
- we replace it with optional parameters

```php
class Math()
{
    public function sum($a, $b, $c=0){

    }
}
```

# static keyword
- refrence to current class, if not exist on it it will look in parent class 

```php
class child extends parent{
    public static function setCountry($country)
    {
        parent::setCountry($country);
        static::$country=$country;
    }
    
}
```

# callStatic magic method 
- that in a magic method in php when i call function in class that is not exist in that class it will call that magic method
- notice that example

```php
class Facade {
    protected $container = 'person';

     public static function __callStatic($method, $args)
    {
        $sc=new ServiceContainer();
        $person=$sc->make(self::$container);
        $person->$method(...$args);
    }
}

Facade::name(); // that will call __callStatic magic method, $method=name, $args=null
Facade::age(1,2,3); // that will call __callStatic magic method, $method=age, $args=[1,2,3]
```


# Auto load, service container & facade in laravel
## Autoload
- that will include all classes i use directly
- it is not the same, laravel use composer for autoloading, that is just something to illustrate the idea
```php
spl_autoload_register(function($className){ // ex: $className ='App/Http/Controller/HomeController'
    include __DIR__."/{$className}.php";
});
```

## service container
- class store variables and objects in it, in array
- it is thing like that, not that exactly but simillar 

```php
class ServiceContainer{
    protected $container=[]; // array to store values

    public function bind($name, $instance) // name of name as key, instance as value (object)
    {
        $this->container[$name]=$instance;
    }

    public function make($name)
    {
        return $this->container[$name];
    }
}
```

## facade
- something like alias to class name, we use it to simplify working with classes, not to use objects, to avoid object dependancy (object dependancy is when class need object of another class to be called)
- it provide static interface

```php
class Facade
{
    protected static $container='person';

    public static function __callStatic($method, $args)
    {
        $person=ServiceContainer::make(self::$container);
        return $person->$method(...$args);
    }
}
```
## to clarify how facade work

```php
// person class 
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
```

```php
include __DIR__.'/autoload.php'; // used to include all classes i use

use A\B\Person;

$person = new Person(); // that object of class 
$person->name='Eman Emad';
ServiceContainer::bind('person', $person); // add object of class person to service container

echo Facade::name('Sandy','Khalid'); // access person class using facade

echo Facade::name();
```