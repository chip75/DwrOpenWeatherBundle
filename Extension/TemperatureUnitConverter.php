<?php

namespace Dwr\OpenWeatherBundle\Extension;

class TemperatureUnitConverter extends \Twig_Extension
{
    const ROUND_FLOAT = 2;

    /**
     * @return array
     */
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('kelvinToCelsius', array($this, 'kelvinToCelsius')),
            new \Twig_SimpleFilter('celsiusToKelvin', array($this, 'celsiusToKelvin')),
            new \Twig_SimpleFilter('kelvinToFahrenheit', array($this, 'kelvinToFahrenheit')),
            new \Twig_SimpleFilter('fahrenheitToKelvin', array($this, 'fahrenheitToKelvin')),
            new \Twig_SimpleFilter('intToDate', array($this, 'intToDate')),
        );
    }

    /**
     * @param string $temp
     * @return float
     */
    public function kelvinToCelsius($temp)
    {
        return round((float) $temp - 273.15, self::ROUND_FLOAT);
    }

    /**
     * @param string $temp
     * @return float
     */
    public function celsiusToKelvin($temp)
    {
        return round((float) $temp + 273.15, self::ROUND_FLOAT);
    }

    /**
     * @param string $temp
     * @return float
     */
    public function kelvinToFahrenheit($temp)
    {
        return round((float) $temp * 9/5 - 459.67, self::ROUND_FLOAT);
    }

    /**
     * @param string $temp
     * @return float
     */
    public function fahrenheitToKelvin($temp)
    {
        return round(((float) $temp + 459.67) * 5/9, self::ROUND_FLOAT);
    }

    /**
     * @param int $int Unix time format
     * @param string $format
     * @return string
     */
    public function intToDate($int, $format = null)
    {
        if ($format) {
            return date($format, $int);
        }
        return date("Y-m-d H:i:s", $int);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'temperature_unit_extension';
    }
}
