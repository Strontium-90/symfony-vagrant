StrontiumPjaxBundle
===================
Helpers for improve [Symfony 2](https://github.com/symfony/symfony) perfomance when working under Vagrant enviroment.

Installation
------------

``` json
{
    "require": {
        "components/jquery-pjax": "*"
    }
}
```

To start using the bundle, register it in your Kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Strontium\PjaxBundle\StrontiumPjaxBundle(),
    );
    // ...
}
```
 
Documentation
-------------



Live Show
---------






License
-------

This bundle is under the MIT license.
