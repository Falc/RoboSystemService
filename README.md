# Robo System Service Tasks

[![License](https://img.shields.io/packagist/l/falc/robo-system-service.svg?style=flat-square)](LICENSE)
[![Build Status](https://img.shields.io/travis/Falc/RoboSystemService.svg?style=flat-square)](https://travis-ci.org/Falc/RoboSystemService)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/Falc/RoboSystemService.svg?style=flat-square)](https://scrutinizer-ci.com/g/Falc/RoboSystemService/)
[![Quality Score](https://img.shields.io/scrutinizer/g/Falc/RoboSystemService.svg?style=flat-square)](https://scrutinizer-ci.com/g/Falc/RoboSystemService/)

Collection of tasks for interacting with system service managers.

## Requirements

+ [Robo](http://robo.li/) ~0.5 (0.5.0 or higher)

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

### Enable

Enabling a service:

``` php
$this->taskServiceEnable()
    ->serviceManager('systemd')
    ->service('service1')
    ->run();
```

Compact form:

```
$this->taskServiceEnable('systemd', 'service1')->run();
```

You can combine it with `taskSshExec()` to enable services in a remote server:

```php
$enableTask = $this->taskServiceEnable()
    ->serviceManager('systemd')
    ->service('service1');

$this->taskSshExec('remote.example.com')
    ->remoteDir('/home/user')
    ->printed(false) // Do not display output
    ->exec($enableTask)
    ->run();
```

### Disable

Disabling a service:

``` php
$this->taskServiceDisable()
    ->serviceManager('systemd')
    ->service('service1')
    ->run();
```

Compact form:

```
$this->taskServiceDisable('systemd', 'service1')->run();
```

You can combine it with `taskSshExec()` to disable services in a remote server:

```php
$disableTask = $this->taskServiceDisable()
    ->serviceManager('systemd')
    ->service('service1');

$this->taskSshExec('remote.example.com')
    ->remoteDir('/home/user')
    ->printed(false) // Do not display output
    ->exec($disableTask)
    ->run();
```

### Daemon reload

This task is supported only for systemd.

``` php
$this->taskServiceDaemonReload()
    ->serviceManager('systemd')
    ->run();
```

Compact form:

```
$this->taskServiceDaemonReload('systemd')->run();
```

You can combine it with `taskSshExec()` to reload systemd manager configuration in a remote server:

```php
$daemonReloadTask = $this->taskServiceDaemonReload()
    ->serviceManager('systemd');

$this->taskSshExec('remote.example.com')
    ->remoteDir('/home/user')
    ->printed(false) // Do not display output
    ->exec($daemonReloadTask)
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
* [SysVinit](http://savannah.nongnu.org/projects/sysvinit)
