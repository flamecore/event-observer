FlameCore EventObserver
=======================

[![Latest Stable](http://img.shields.io/packagist/v/flamecore/event-observer.svg)](https://packagist.org/packages/flamecore/event-observer)
[![Build Status](https://img.shields.io/travis/FlameCore/EventObserver.svg)](https://travis-ci.org/FlameCore/EventObserver)
[![Code Climate](http://img.shields.io/codeclimate/github/FlameCore/EventObserver.svg)](https://codeclimate.com/github/FlameCore/EventObserver)
[![License](http://img.shields.io/packagist/l/flamecore/event-observer.svg)](http://www.flamecore.org/projects/event-observer)

This library allows you to watch events and react to them.

Usage instructions and more information can be found [in our Wiki](https://github.com/FlameCore/EventObserver/wiki).


Getting Started
---------------

Create a new Responder object which holds the event listeners:

```php
$responder = new Responder();
$responder->setListener('action.event', function (array $data, $event) {
    print_r($data);
});
```

Create a new Observer object and give it some actions to react to:

```php
$observer = new Observer();
$observer->addResponder('action', $responder);
```

Notify the Observer of events (optionally with data):

```php
$observer->notify('action.event');
$observer->notify('action.event', ['some_data' => 123.4]);
```


Installation
------------

### Install via Composer

Create a file called `composer.json` in your project directory and put the following into it:

```
{
    "require": {
        "flamecore/event-observer": "1.0.*"
    }
}
```

[Install Composer](https://getcomposer.org/doc/00-intro.md#installation-nix) if you don't already have it present on your system:

    $ curl -sS https://getcomposer.org/installer | php

Use Composer to [download the vendor libraries](https://getcomposer.org/doc/00-intro.md#using-composer) and generate the vendor/autoload.php file:

    $ php composer.phar install

Include the vendor autoloader and use the classes:

```php
namespace Acme\MyApplication;

use FlameCore\EventObserver\Observer;
use FlameCore\EventObserver\Responder\Responder;

require_once 'vendor/autoload.php';
```


Requirements
------------

* You must have at least PHP version 5.4 installed on your system.


Contributors
------------

If you want to contribute, please see the [CONTRIBUTING](CONTRIBUTING.md) file first.

Thanks to the contributors:

* Christian Neff (secondtruth)
