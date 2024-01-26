# what is vendor?
When you're working on a PHP project, especially in the context of modern PHP development using tools like Composer, a "vendor" typically refers to the `directory` where `Composer installs dependencies for your project`. Composer is a dependency manager for PHP that allows you to declare the libraries your project depends on and manages them for you.

Here's a basic overview:

1. **Composer**: Composer is a tool for dependency management in PHP. It allows you to declare the libraries your project depends on and installs them for you.

2. **Vendor Directory**: When you run `composer install` or `composer update`, Composer creates a "vendor" directory in your project. This directory contains the dependencies (third-party libraries) that your project relies on.

3. **Autoloading**: Composer generates an autoloader in the vendor directory, which makes it easy for your PHP code to use classes and functions from the installed dependencies.

For example, in a typical PHP project, you might see a `vendor` directory that contains subdirectories for various libraries your project depends on. This directory is often added to the `.gitignore` file since it's generally not necessary to version control the actual library code.

Here's a simplified directory structure:

```
/your_project
    /vendor
        /vendor_name
            /library1
            /library2
        /another_vendor
            /library3
    /src
        Your PHP source code files
    composer.json
    composer.lock
```

In the above structure, the `/vendor` directory contains the third-party libraries (vendors) installed by Composer.

The `composer.json` file in the root of your project specifies the dependencies and configuration for Composer, and `composer.lock` keeps track of the exact versions of dependencies installed in your project.

# php artisan
- when i am inside project i call it
- it will call artisan file inside laravel project i am in 

# request life cycle in php
- *that life cycle is very important because i will know every part of code work in any place and then can put code work right*
- ex: session start in middle ware so in any file before it i can't write code to know how is the user login for example
![](./images/lifecycle.jpg)
- any requests are directed to index file 
- images, front end folders and any thing that will appear to the user must be in public folder

- app service provider
  - contain all that i will include in every request like database, language
  - app/http/kernal: load service providers 
  - service provider: do register for service provider then boot it

- dispatch request & router
  - what is the controller that will excute that request
  - in that controller will not excute, we only know what is it 
- middleware
  - for check complete or not
  - authentication or prvillages
  - session_start here

- contoller: excute request
- view: return page to user

# service container
- container i store vaibles in 
## facade class
- class gives me access to object with static method
- i must declare it in service container
- ex: 

```php
Route::get('/', function(){
    return view('welcome');
});
// that Route class is a facade class refere to router object
// that is equal to 
$router = app()->make('router'); // that name of the object is declared in service container
$router->get('/', function(){
    return view('welcome');
});
```