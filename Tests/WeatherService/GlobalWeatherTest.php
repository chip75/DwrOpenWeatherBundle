<?php
namespace Dwr\GlobalWeatherBundle\Tests;

use Dwr\GlobalWeatherBundle\Entity\Location;
use Dwr\GlobalWeatherBundle\Utility\ParserXML;
use Dwr\GlobalWeatherBundle\WeatherService\Client\GlobalWeatherClient;
use Dwr\GlobalWeatherBundle\WeatherService\GlobalWeather;

class GlobalWeatherTest extends \PHPUnit_Framework_TestCase
{
    public function testIfGetCurrentWeatherReturnsSimpleXMLObject()
    {
        $expectedResponseXML = '<?xml version="1.0" encoding="utf-16"?>
                                <CurrentWeather>
                                    <Location>Test Location</Location>
                                </CurrentWeather>';

        $globalWeatherSoapServiceMock = $this->getGlobalWeatherClientMock($expectedResponseXML);
        $globalWeather = new GlobalWeather($globalWeatherSoapServiceMock, new ParserXML());

        $this->assertInstanceOf('SimpleXMLElement', $globalWeather->getCurrentWeather(new Location()));
    }

    public function testIfGetCurrentWeatherReturnsObjectWithCorrectAttributes()
    {
        $expectedLocation = 'Test Location';
        $expectedTemperature = 'Test Temperature';
        $expectedResponseXML = sprintf('<?xml version="1.0" encoding="utf-16"?>
                                <CurrentWeather>
                                    <Location>%s</Location>
                                    <Temperature>%s</Temperature>
                                </CurrentWeather>', $expectedLocation, $expectedTemperature);

        $globalWeatherSoapServiceMock = $this->getGlobalWeatherClientMock($expectedResponseXML);
        $globalWeather = new GlobalWeather($globalWeatherSoapServiceMock, new ParserXML());
        $currentWeather = $globalWeather->getCurrentWeather(new Location());

        $this->assertSame($expectedLocation, (string)$currentWeather->Location);
        $this->assertSame($expectedTemperature, (string)$currentWeather->Temperature);
    }

    public function _testIfGetCurrentWeatherReturnsFalseWhenErrorConnection()
    {
        $globalWeather = new GlobalWeather($this->getGlobalWeatherConnectionErrorMock(), new ParserXML());

        var_dump($globalWeather->getCurrentWeather(new Location()));
        die(__FILE__.'\\'.__LINE__);

        $this->assertFalse($globalWeather->getCurrentWeather(new Location()));
    }

    private function getGlobalWeatherClientMock($expectedResponseXML)
    {
        $clientMock = $this->getMockBuilder('Dwr\GlobalWeatherBundle\WeatherService\Client\GlobalWeatherClient')
            ->disableOriginalConstructor()
            ->getMock();

        $clientMock->expects($this->once())
            ->method('connect')
            ->will($this->returnValue($this->getGlobalWeatherSoapServiceMock($expectedResponseXML)));
        return $clientMock;
    }

    private function getGlobalWeatherSoapServiceMock($expectedResponseXML)
    {
        $soapServiceMock = $this->getMockBuilder('\SoapClient')
            ->disableOriginalConstructor()
            ->setMethods(array('getWeather'))
            ->getMock();

        $globalWeatherResponse = new \stdClass();
        $globalWeatherResponse->GetWeatherResult = $expectedResponseXML;

        $soapServiceMock->expects($this->once())
            ->method('getWeather')
            ->will($this->returnValue($globalWeatherResponse));

        return $soapServiceMock;
    }

    private function getGlobalWeatherConnectionErrorMock()
    {
        $clientMock = $this->getMockBuilder('Dwr\GlobalWeatherBundle\WeatherService\Client\GlobalWeatherClient')
            ->disableOriginalConstructor()
            ->getMock();

        $clientMock->expects($this->once())
            ->method('connect')
            ->will($this->returnValue(new \Exception('Connection Error')));
        return $clientMock;
    }
}
