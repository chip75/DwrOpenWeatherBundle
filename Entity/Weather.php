<?php

namespace Dwr\OpenWeatherBundle\Entity;

class Weather
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $coord;

    /**
     * @var array
     */
    private $weather;

    /**
     * @var string
     */
    private $base;

    /**
     * @var array
     */
    private $main;

    /**
     * @var int
     */
    private $visibility;

    /**
     * @var array
     */
    private $wind;

    /**
     * @var array
     */
    private $clouds;

    /**
     * @var int
     */
    private $dt;

    /**
     * @var array
     */
    private $sys;

    /**
     * Weather constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    /**
     * @return int
     */
    public function cityId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function cityName()
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function coord()
    {
        return $this->coord;
    }

    /**
     * @return array
     */
    public function weather()
    {
        return $this->weather;
    }

    /**
     * @return string
     */
    public function base()
    {
        return $this->base;
    }

    /**
     * @return array
     */
    public function main()
    {
        return $this->main;
    }

    /**
     * @return int
     */
    public function visibility()
    {
        return $this->visibility;
    }

    /**
     * @return array
     */
    public function wind()
    {
        return $this->wind;
    }

    /**
     * @return array
     */
    public function clouds()
    {
        return $this->clouds;
    }

    /**
     * @return int
     */
    public function dt()
    {
        return $this->dt;
    }

    /**
     * @return array
     */
    public function sys()
    {
        return $this->sys;
    }

    /**
     * @return string
     */
    public function icon()
    {
        return ($this->weather) ? $this->weather[0]['icon'] : '';
    }

    /**
     * @return string
     */
    public function description()
    {
        return ($this->weather) ? $this->weather[0]['description'] : '';
    }

    /**
     * @return float|string
     */
    public function temp()
    {
        return ($this->main) ? $this->main['temp'] : '';
    }

    /**
     * @return float|string
     */
    public function pressure()
    {
        return ($this->main) ? $this->main['pressure'] : '';
    }

    /**
     * @return float|string
     */
    public function humidity()
    {
        return ($this->main) ? $this->main['humidity'] : '';
    }

    /**
     * @return float|string
     */
    public function tempMin()
    {
        return ($this->main) ? $this->main['temp_min'] : '';
    }

    /**
     * @return float|string
     */
    public function tempMax()
    {
        return ($this->main) ? $this->main['temp_max'] : '';
    }

    /**
     * @return float|string
     */
    public function windSpeed()
    {
        return ($this->wind) ? $this->wind['speed'] : '';
    }

    /**
     * @return int|string
     */
    public function windDeg()
    {
        return ($this->wind) ? $this->wind['deg'] : '';
    }

    /**
     * @return string
     */
    public function country()
    {
        return ($this->sys) ? $this->sys['country'] : '';
    }

    /**
     * @return int|string
     */
    public function sunrise()
    {
        return ($this->sys) ? $this->sys['sunrise'] : '';
    }

    /**
     * @return int|string
     */
    public function sunset()
    {
        return ($this->sys) ? $this->sys['sunset'] : '';
    }
}
