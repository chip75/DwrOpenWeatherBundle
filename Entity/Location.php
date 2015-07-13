<?php
namespace Dwr\GlobalWeatherBundle\Entity;

class Location
{
    private $location;
    private $city;
    private $country;

    public function setLocation($location)
    {
        $this->location = $location;
        list($this->country, $this->city) = explode(',', $location);

        return $this;
    }

    public function getLocation()
    {
        return $this->location;
    }

    public function getCountry()
    {
        return trim($this->country);
    }

    public function getCity()
    {
        return trim($this->city);
    }
}
