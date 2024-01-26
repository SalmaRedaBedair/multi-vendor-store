# self & this
- i can't use this inside static classes so i use self instead

```php
class Person{
    public static $country;
    public static setCountry($country)
    {
        self::$country=$country
    }
}

```
# static properity
- static over all class, if it is changes by one object it will be changed for all other objects of that class

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

# closure function
- function passed to another function with no name 

# className::class
- that will return class name and namespace like that `app/http/controller/StoreController`

# interface
- all methods inside it must be public only

# overload is not allowed in php
- we replace it with optional parameters

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

# service container in laravel
- class store variables in it, in array
- it is thing like that, not that exactly but simillar 

```php
class ServiceContainer{
    protected $container=[];

    public function bind($name, $instance)
    {
        $this->container[$name]=$instance;
    }

    public function make($name)
    {
        return $this->container[$name];
    }
}
```

# callStatic magic method & facade
- that in a magic method in php when i call function in class that is not exist in that class it will call that magic method
- norice that example

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


# Understanding Autoload, Service Container, and Facade in Laravel

## Autoload: Effortless Class Loading

In Laravel, the autoload mechanism eliminates the need to manually include class files. This is achieved through the use of the `spl_autoload_register` function and a dedicated autoloader class. Let's break down the process:

```php
class Autoloader
{
    public static function register($classname) {
        include __DIR__ . "/{$classname}.php";
    }
}

spl_autoload_register([Autoloader::class, 'register']);
```

The `Autoloader` class provides a `register` method responsible for including the PHP file corresponding to the specified class. By registering this method with `spl_autoload_register`, Laravel ensures that when a class is referenced but not yet defined, the autoloader kicks in and attempts to load the class file automatically.

This autoload mechanism simplifies the development process, allowing developers to focus on writing code without the need for manual file inclusions, i only call class and it will included directly.

## Service Container: Managing Dependencies with Elegance

The service container in Laravel is a powerful tool for managing class dependencies and performing dependency injection. It serves as a centralized repository for instances of objects, allowing for easy retrieval and binding of dependencies.

dependency here mean if object need instance of another object it will be handeled then pass to service container and access it using only one word.

```php
class ServiceContainer{
    protected static $container=[];

    public function bind($name, $instance)
    {
        self::$container[$name]=$instance;
    }

    public function make($name)
    {
        return self::$container[$name];
    }
}
```

Here, the `ServiceContainer` class includes a static `$container` property to store instances. The `bind` method binds an instance to a name in the container, while the `make` method retrieves an instance based on the provided name.

By utilizing the service container, Laravel promotes a modular and flexible architecture. Developers can easily manage and inject dependencies throughout their application, enhancing code organization and maintainability.

## Facade: Simplifying Access to Complex Systems

use to access services in service container

Laravel facades provide a static interface to classes that are available in the service container. Facades offer a convenient way to interact with underlying classes without needing to instantiate them explicitly. Let's see how this works:

```php
class SomeService
{
    public function doSomething()
    {
        return 'Doing something...';
    }
}

class SomeServiceFacade
{
    protected static function getFacadeAccessor()
    {
        return 'some-service';
    }
}

// In the service container
$container->bind('some-service', SomeService::class);

// In application code
echo SomeServiceFacade::doSomething(); // Output: Doing something...
```

In this example, the `SomeServiceFacade` class serves as a facade for the `SomeService` class. By implementing the `getFacadeAccessor` method, the facade specifies the key under which the actual service is registered in the service container.

When developers use the facade in their application code, Laravel resolves the facade to the underlying service from the service container, providing a clean and concise syntax for accessing complex systems.

## Conclusion

Laravel's autoload, service container, and facade components work seamlessly together to enhance the developer experience. The autoload mechanism simplifies class loading, the service container facilitates dependency management, and facades provide an elegant syntax for interacting with complex systems. Understanding and leveraging these features empowers Laravel developers to create robust and maintainable applications.

# Robust:

A robust application is one that can handle a variety of inputs, scenarios, and potential issues without breaking or crashing. It is resilient to errors and can gracefully recover from unexpected situations. In the context of Laravel, a robust application built with proper error handling, validation, and well-structured code is less prone to bugs and failures.