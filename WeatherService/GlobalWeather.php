<?php
namespace Dwr\GlobalWeatherBundle\WeatherService;

use Dwr\GlobalWeatherBundle\Utility\ParserXML;
use Dwr\GlobalWeatherBundle\Entity\Location;
use Dwr\GlobalWeatherBundle\WeatherService\Client\GlobalWeatherClient as GlobalWeatherClient;

class GlobalWeather
{
    /**
     * @var \SoapClient
     */
    private $globalWeatherClient;

    /**
     * @var ParserXML
     */
    private $parserXML;

    /**
     * @param GlobalWeatherClient $client
     * @param ParserXML $parserXML
     */
    public function __construct(GlobalWeatherClient $client, ParserXML $parserXML)
    {
        $this->globalWeatherClient = $client->connect();
        $this->parserXML = $parserXML;
    }

    /**
     * @param Location $location
     * @return boolean|\SimpleXMLElement
     */
    public function getCurrentWeather(Location $location)
    {
        $xml = $this->getWeatherResultXML($location);
        return $this->parserXML->parseXML($xml);
    }

    /**
     * @param Location $location
     * @return boolean
     */
    private function getWeatherResultXML(Location $location)
    {
        try {
            $globalWeather = $this->globalWeatherClient->GetWeather(
                [
                    'CityName' => $location->getCity(),
                    'CountryName' => $location->getCountry()
                ]
            );
            return $globalWeather->GetWeatherResult;
        } catch (\Exception $e) {
            return false;
        }
    }
}
