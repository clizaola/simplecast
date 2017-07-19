# Simplecast Wrapper Package for Laravel

## Installation

To get the latest version, simply require the project using [Composer](https://getcomposer.org):

```bash
$ composer require clizaola/simplecast
```

## Configuration

Add the Service provider class inside of the /config/app.php in the providers section
```php
    'providers' => [
        ...
        Clizaola\Simplecast\SimplecastServiceProvider::class,
        ...
    ]

```

Add the Facade class inside of the /config/app.php in the aliases section
```php
    'aliases' => [
        ...
        'Simplecast' => Clizaola\Simplecast\SimplecastFacade::class
        ...
    ]

```

Add the configuration API Key to the /config/services.php, you can find the an example on the folder /config of this package

```php
<?php
    return[
        ...
        'simplecast' => [
            'key' => env('SIMPLECAST_KEY'),
        ]
    ]
```

#### Enjoy!

## License

This package is licensed under [The MIT License (MIT)](LICENSE).
