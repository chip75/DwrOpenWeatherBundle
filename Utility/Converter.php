<?php

namespace Dwr\OpenWeatherBundle\Utility;

class Converter
{
    const ROUND_FLOAT = 2;
    public static function kelvinToCelsius($temp)
    {
        return round((float) $temp - 273.15, self::ROUND_FLOAT);
    }
    public static function celsiusToKelvin($temp)
    {
        return round((float) $temp + 273.15, self::ROUND_FLOAT);
    }
    public static function kelvinToFahrenheit($temp)
    {
        return round((float) $temp * 9/5 - 459.67, self::ROUND_FLOAT);
    }
    public static function fahrenheitToKelvin($temp)
    {
        return round(((float) $temp + 459.67) * 5/9, self::ROUND_FLOAT);
    }
    public static function intToDate($int, $format = null)
    {
        if ($format) {
            return date($format, $int);
        }
        return date("Y-m-d H:i:s", $int);
    }
}