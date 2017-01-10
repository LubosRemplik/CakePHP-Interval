# Interval plugin for CakePHP

[![Build Status](https://travis-ci.org/LubosRemplik/CakePHP-Interval.svg)](https://travis-ci.org/LubosRemplik/CakePHP-Interval)
[![Latest Stable Version](https://poser.pugx.org/lubos/cakephp-interval/v/stable.svg)](https://packagist.org/packages/lubos/cakephp-interval) 
[![Total Downloads](https://poser.pugx.org/lubos/cakephp-interval/downloads.svg)](https://packagist.org/packages/lubos/cakephp-interval) 
[![Latest Unstable Version](https://poser.pugx.org/lubos/cakephp-interval/v/unstable.svg)](https://packagist.org/packages/lubos/cakephp-interval) 
[![License](https://poser.pugx.org/lubos/cakephp-interval/license.svg)](https://packagist.org/packages/lubos/cakephp-interval)

## Installation

You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).

The recommended way to install composer packages is:

```
composer require lubos/cakephp-interval
```

Load plugin in bootstrap.php file

```
bin/cake plugin load Interval
```

## Usage

```php
$Interval = new \Interval\Interval();

// output 2w 6h
echo $Interval->toHuman((2 * 5 * 8 + 6) * 3600);

// output 36000
echo $Interval->toSeconds('1d 2h');
```

See ./tests/TestCase/Interval/IntervalTest.php for more examples

## Bugs & Features

For bugs and feature requests, please use the issues section of this repository.

If you want to help, pull requests are welcome.  
Please follow few rules:  

- Fork & clone
- Code bugfix or feature
- Follow [CakePHP coding standards](https://github.com/cakephp/cakephp-codesniffer)
- Unit tests
