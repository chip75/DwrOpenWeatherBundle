<?php
namespace Dwr\GlobalWeatherBundle\WeatherService;

use Dwr\GlobalWeatherBundle\WeatherService\Client\GlobalWeatherClient;
use Dwr\GlobalWeatherBundle\Entity\Location;

class GlobalWeather
{
    private $globalWeatherClient;

    public function __construct(GlobalWeatherClient $client)
    {
        $this->globalWeatherClient = $client->connect();
    }

    public function getCurrentWeather(Location $location)
    {
        try {
            $globalWeather = $this->globalWeatherClient->GetWeather(
                [
                    'CityName' => $location->getCity(),
                    'CountryName' => $location->getCountry()
                ]
            );

            var_dump($globalWeather->GetWeatherResult);

            return $globalWeather->GetWeatherResult;
        } catch (\Exception $e) {
            var_dump($e->getMessage());
        }
    }
}