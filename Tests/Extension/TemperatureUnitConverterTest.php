<?php

namespace Dwr\OpenWeatherBundle;

use Dwr\OpenWeatherBundle\Extension\TemperatureUnitConverter;

class TemperatureUnitConverterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param float $kelvin
     * @param float $celsius
     *
     * @dataProvider kelvinToCelsiusProvider
     */
    public function testConvertKelvinToCelsius($kelvin, $celsius)
    {
        $extension = new TemperatureUnitConverter();
        $this->assertEquals($celsius, $extension->kelvinToCelsius($kelvin));
    }
    /**
     * @return array
     */
    public function kelvinToCelsiusProvider()
    {
        return [
            [0, -273.15],
            [273.15, 0],
            [373.15, 100]
        ];
    }
    /**
     * @param float $celsius
     * @param float $kelvin
     *
     * @dataProvider celsiusToKelvinProvider
     */
    public function testConvertCelsiusToKelvin($celsius, $kelvin)
    {
        $extension = new TemperatureUnitConverter();
        $this->assertEquals($kelvin, $extension->celsiusToKelvin($celsius));
    }
    /**
     * @return array
     */
    public function celsiusToKelvinProvider()
    {
        return [
            [-273.15, 0],
            [0, 273.15],
            [100, 373.15]
        ];
    }
    /**
     * @param float $kelvin
     * @param float $fahrenheit
     *
     * @dataProvider kelvinToFahrenheitProvider
     */
    public function testConvertKelvinToFahrenheit($kelvin, $fahrenheit)
    {
        $extension = new TemperatureUnitConverter();
        $this->assertEquals($fahrenheit, $extension->kelvinToFahrenheit($kelvin));
    }
    /**
     * @return array
     */
    public function kelvinToFahrenheitProvider()
    {
        return [
            [0, -459.67],
            [270, 26.33],
            [255.37, 0]
        ];
    }
    /**
     * @param float $fahrenheit
     * @param float $kelvin
     *
     * @dataProvider fahrenheitToKelvinProvider
     */
    public function testConvertFahrenheitToKelvin($fahrenheit, $kelvin)
    {
        $extension = new TemperatureUnitConverter();
        $this->assertEquals($kelvin, $extension->fahrenheitToKelvin($fahrenheit));
    }
    /**
     * @return array
     */
    public function fahrenheitToKelvinProvider()
    {
        return [
            [-459.67, 0],
            [26.33, 270],
            [0, 255.37]
        ];
    }
    /**
     * @param array $actual
     * @param string $expected
     *
     * @dataProvider intToDateProvider
     */
    public function testConvertIntToDateWithDefaultFormat($actual, $expected)
    {
        $extension = new TemperatureUnitConverter();
        $this->assertEquals($expected, $extension->intToDate($actual['idate'], $actual['format']));
    }
    /**
     * @return array
     */
    public function intToDateProvider()
    {
        return [
            [['idate' => 0, 'format' => null], '1970-01-01 00:00:00'],
            [['idate' => 1, 'format' => null], '1970-01-01 00:00:01'],
            [['idate' => 946684800, 'format' => null], '2000-01-01 00:00:00'],
            [['idate' => 1486935615, 'format' => null], '2017-02-12 21:40:15'],
            [['idate' => 1486935615, 'format' => 'H:i:s'], '21:40:15'],
            [['idate' => 1486935615, 'format' => 'Ymd'], '20170212']
        ];
    }
}