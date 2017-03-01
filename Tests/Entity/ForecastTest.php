<?php

namespace Dwr\OpenWeatherBundle;

use Dwr\OpenWeatherBundle\Entity\Forecast;

class ForecastTest extends  \PHPUnit_Framework_TestCase
{
    public function testForecastEntityInfill()
    {
        $jsonData = '{
            "city": {
                "id": 1,
                "name": "testCity",
                "coord": {
                    "lon": 0.01,
                    "lat": 0.02
                },
                "country": "textCountry",
                "population": 0,
                "sys": [
                    {
                        "population": 0
                    }
                ]
            },
            "message": 0.0036,
            "cnt": 36,
            "list": [
                {
                    "dt": 1486728000,
                    "main": {
                        "temp": 275.58,
                        "temp_min": 275.39,
                        "temp_max": 275.58,
                        "pressure": 1031.69,
                        "sea_level": 1039.55,
                        "grnd_level": 1031.69,
                        "humidity": 83,
                        "temp_kf": 0.19
                    },
                    "weather": [
                        {
                            "id": 800,
                            "main": "Clear",
                            "description": "clear sky",
                            "icon": "01d"
                        }
                    ],
                    "clouds": {
                        "all": 76
                    },
                    "wind": {
                        "speed": 5.01,
                        "deg": 32.5026
                    },
                    "rain": [],
                    "snow": {
                        "3h": 0.005
                    },
                    "sys": {
                        "pod": "d"
                    },
                    "dt_txt": "2017-02-10 15:00:00"
                },
                {
                    "dt": 1486728001,
                    "main": {
                        "temp": 276.58,
                        "temp_min": 276.39,
                        "temp_max": 277.58,
                        "pressure": 1032.69,
                        "sea_level": 1031.55,
                        "grnd_level": 1033.69,
                        "humidity": 84,
                        "temp_kf": 0.11
                    },
                    "weather": [
                        {
                            "id": 600,
                            "main": "Snow",
                            "description": "light snow",
                            "icon": "13n"
                        }
                    ],
                    "clouds": {
                        "all": 88
                    },
                    "wind": {
                        "speed": 3.01,
                        "deg": 3.5026
                    },
                    "rain": [],
                    "snow": {
                        "3h": 0.019
                    },
                    "sys": {
                        "pod": "n"
                    },
                    "dt_txt": "2017-02-11 00:00:00"
                }
            ]
        }';

        $arrayData = json_decode($jsonData, true);
        $entity = new Forecast($arrayData);

        $this->assertEquals($entity->city(), $arrayData['city']);
        $this->assertEquals($entity->cityName(), $arrayData['city']['name']);
        $this->assertEquals($entity->country(), $arrayData['city']['country']);
        $this->assertEquals($entity->message(), $arrayData['message']);
        $this->assertEquals($entity->cnt(), $arrayData['cnt']);
        $this->assertEquals($entity->lists(), $arrayData['list']);
    }
}
