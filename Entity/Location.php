<?php
namespace Dwr\GlobalWeatherBundle\Entity;

class Location
{
    private $location;

    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    public function getLocation()
    {
        return $this->location;
    }

}