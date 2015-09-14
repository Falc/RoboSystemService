# Robo System Service Tasks

[![License](https://img.shields.io/packagist/l/falc/robo-system-service.svg?style=flat-square)](LICENSE)

Collection of tasks for interacting with system service managers.

## Requirements

+ [Robo](http://robo.li/) 0.5.*

## Installation

Add the `falc/robo-system-service` package to your `composer.json`:

```
composer require falc/robo-system-service
```

Add the `Falc\Robo\Service\loadTasks` trait to your `RoboFile`:

```php
class RoboFile extends \Robo\Tasks
{
    use Falc\Robo\Service\loadTasks;

    // ...
}
```

## Tasks

### Start

Starting a service:

``` php
$this->taskServiceStart()
    ->serviceManager('systemd')
    ->service('service1')
    ->run();
```

Compact form:

```
$this->taskServiceStart('systemd', 'service1')->run();
```

You can combine it with `taskSshExec()` to start services in a remote server:

```php
$startTask = $this->taskServiceStart()
    ->serviceManager('systemd')
    ->service('service1');

$this->taskSshExec('remote.example.com')
    ->remoteDir('/home/user')
    ->printed(false) // Do not display output
    ->exec($startTask)
    ->run();
```

### Stop

Stopping a service:

``` php
$this->taskServiceStop()
    ->serviceManager('systemd')
    ->service('service1')
    ->run();
```

Compact form:

```
$this->taskServiceStop('systemd', 'service1')->run();
```

You can combine it with `taskSshExec()` to stop services in a remote server:

```php
$stopTask = $this->taskServiceStop()
    ->serviceManager('systemd')
    ->service('service1');

$this->taskSshExec('remote.example.com')
    ->remoteDir('/home/user')
    ->printed(false) // Do not display output
    ->exec($stopTask)
    ->run();
```

### Restart

Restarting a service:

``` php
$this->taskServiceRestart()
    ->serviceManager('systemd')
    ->service('service1')
    ->run();
```

Compact form:

```
$this->taskServiceRestart('systemd', 'service1')->run();
```

You can combine it with `taskSshExec()` to restart services in a remote server:

```php
$restartTask = $this->taskServiceRestart()
    ->serviceManager('systemd')
    ->service('service1');

$this->taskSshExec('remote.example.com')
    ->remoteDir('/home/user')
    ->printed(false) // Do not display output
    ->exec($restartTask)
    ->run();
```

## Methods

All the tasks implement these methods:
 * `serviceManager($serviceManager)`: Sets the service manager to use.
 * `service()`: Sets the service to manage.
 * `verbose()`: Enables the verbose mode.

## Service managers

Every task requires to set a service manager either in the constructor or using the `serviceManager($serviceManager)` method.

At the moment these are the supported service managers:
* [systemd](http://www.freedesktop.org/wiki/Software/systemd/)
