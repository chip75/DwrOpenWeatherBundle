<?php

namespace Dwr\OpenWeatherBundle;

use Dwr\OpenWeatherBundle\Entity\Weather;

class WeatherTest extends  \PHPUnit_Framework_TestCase
{
    public function testWeatherEntityInfill()
    {
        $jsonData  = '{
            "id": 1,
            "name": "testCity",
            "coord": {
                "lon": "0.01",
                "lat": "0.02"
            },
            "weather": [
                {
                    "id": 300,
                    "main": "Drizzle",
                    "description": "light intensity drizzle",
                    "icon": "09d"
                }
            ],
            "base": "station",
            "main": {
                "temp": 274.15,
                "pressure": 1024,
                "humidity": 93,
                "temp_min": 273.15,
                "temp_max": 275.15
            },
            "visibility": 1800,
            "wind": {
                "speed": 5.7,
                "deg": 20
            },
            "clouds": {
                "all" : 90
            },
            "dt": 1486714800,
            "sys": {
                "type": 1,
                "id": 5091,
                "message": 0.037,
                "country": "testCountry",
                "sunrise": 1486711368,
                "sunset": 1486746447
            }
        }';

        $arrayData = json_decode($jsonData, true);
        $entity = new Weather($arrayData);

        $this->assertEquals($entity->cityId(), $arrayData['id']);
        $this->assertEquals($entity->cityName(), $arrayData['name']);
        $this->assertEquals($entity->coord(), $arrayData['coord']);
        $this->assertEquals($entity->weather(), $arrayData['weather']);
        $this->assertEquals($entity->base(), $arrayData['base']);
        $this->assertEquals($entity->main(), $arrayData['main']);
        $this->assertEquals($entity->visibility(), $arrayData['visibility']);
        $this->assertEquals($entity->wind(), $arrayData['wind']);
        $this->assertEquals($entity->clouds(), $arrayData['clouds']);
        $this->assertEquals($entity->dt(), $arrayData['dt']);
        $this->assertEquals($entity->sys(), $arrayData['sys']);
        $this->assertEquals($entity->icon(), $arrayData['weather'][0]['icon']);
        $this->assertEquals($entity->description(), $arrayData['weather'][0]['description']);
        $this->assertEquals($entity->temp(), $arrayData['main']['temp']);
        $this->assertEquals($entity->pressure(), $arrayData['main']['pressure']);
        $this->assertEquals($entity->humidity(), $arrayData['main']['humidity']);
        $this->assertEquals($entity->tempMin(), $arrayData['main']['temp_min']);
        $this->assertEquals($entity->tempMax(), $arrayData['main']['temp_max']);
        $this->assertEquals($entity->windSpeed(), $arrayData['wind']['speed']);
        $this->assertEquals($entity->windDeg(), $arrayData['wind']['deg']);
        $this->assertEquals($entity->country(), $arrayData['sys']['country']);
        $this->assertEquals($entity->sunrise(), $arrayData['sys']['sunrise']);
        $this->assertEquals($entity->sunset(), $arrayData['sys']['sunset']);
    }
}
