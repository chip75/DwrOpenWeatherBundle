<?php

namespace Dwr\OpenWeatherBundle\Extension;

use Dwr\OpenWeatherBundle\Utility\Converter;
use Twig_Extension;
use Twig_SimpleFilter;

class TemperatureUnitConverter extends Twig_Extension
{
    /**
     * @return array
     */
    public function getFilters()
    {
        return array(
            new Twig_SimpleFilter('kelvinToCelsius', array($this, 'kelvinToCelsius')),
            new Twig_SimpleFilter('celsiusToKelvin', array($this, 'celsiusToKelvin')),
            new Twig_SimpleFilter('kelvinToFahrenheit', array($this, 'kelvinToFahrenheit')),
            new Twig_SimpleFilter('fahrenheitToKelvin', array($this, 'fahrenheitToKelvin')),
            new Twig_SimpleFilter('intToDate', array($this, 'intToDate')),
        );
    }

    /**
     * @param string $temp
     * @return float
     */
    public function kelvinToCelsius($temp)
    {
        return Converter::kelvinToCelsius($temp);
    }

    /**
     * @param string $temp
     * @return float
     */
    public function celsiusToKelvin($temp)
    {
        return Converter::celsiusToKelvin($temp);
    }

    /**
     * @param string $temp
     * @return float
     */
    public function kelvinToFahrenheit($temp)
    {
        return Converter::kelvinToFahrenheit($temp);
    }

    /**
     * @param string $temp
     * @return float
     */
    public function fahrenheitToKelvin($temp)
    {
        return Converter::fahrenheitToKelvin($temp);
    }

    /**
     * @param int $int Unix time format
     * @param string $format
     * @return string
     */
    public function intToDate($int, $format = null)
    {
        return Converter::intToDate($int, $format);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'temperature_unit_extension';
    }
}
