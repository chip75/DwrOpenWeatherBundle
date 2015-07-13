[![SensioLabsInsight](https://insight.sensiolabs.com/projects/a32fc8c5-0bc8-4daa-8b8d-eb2696de949c/big.png)](https://insight.sensiolabs.com/projects/a32fc8c5-0bc8-4daa-8b8d-eb2696de949c)
======================

This bundle allows create weather widget in your application.

## **Installation**

Installation is a quick 4 steps process:

1. Download DwrAvatarBundle using composer
2. Enable the Bundle
3. Add locations where you would like to check current weather
4. Add routing to routing.yml in order to can open example in your browser

### Step 1: Download DwrAvatarBundle using composer

Add DwrGlobalWeatherBundle in your composer.json:

```js
{
    "require": {
        "dwr/globalweather-bundle": "1.0"
    }
}
```

Download the bundle by running the command:

``` bash
$ php composer.phar update dwr/globalweather-bundle
```

Composer will install the bundle into your project's `vendor/dwr/globalweather-bundle` directory.

### Step 2: Enable the bundle

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Dwr\GlobalWeatherBundle\DwrGlobalWeatherBundle(),
    );
}
```

### Step 3: Add locations where you would like to check current weather

In order to add your own locations add example code in your **app/config/config.yml**.

Example:
``` yml
dwr_global_weather_locations:
      United States: [New York]
```

#### Find supported locations

For more locations you will need to check official Global Weather site where you can find supported location.

Global Weather Webservice: [Global Weather](http://www.webservicex.net/ws/WSDetails.aspx?CATID=12&WSID=56)
If you want get cities by country try this: [GetCitiesByCountry](http://www.webservicex.net/globalweather.asmx?op=GetCitiesByCountry)
Try to get Weather by city and country: [GetWeather](http://www.webservicex.net/globalweather.asmx?op=GetWeather)

#### Hint

Default locations are defined in vendor/dwr/globalweather-bundle/Dwr/GlobalWeatherBundle/Resources/config/services.yml
and they look like that:

``` yml
dwr_global_weather_locations:
      Australia: [Sydney Airport]
      Germany: [Berlin]
      Japan: [Tokyo]
      Poland: [Katowice, Krakow, Warszawa-Okecie]
      Russian Federation: [Moscow]
      Spain: [Barcelona, Fuerteventura, Las Palmas De Gran Canaria / Gando]
      United States: [New York]
```

### Step 4: Add routing to routing.yml in order to can open example in your browser

``` yml
dwr_global_weather:
    resource: "@DwrGlobalWeatherBundle/Controller/"
    type:     annotation
    prefix:   /dwr_globalweather
```

Congratulations! You're ready to embed weather widget in your symfony2 application.
Example how this widget works you can find on: yours-application-url/dwr_globalweather/globalweather.
