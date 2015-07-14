<?php
namespace Dwr\GlobalWeatherBundle\Tests;

use Dwr\GlobalWeatherBundle\Entity\Location;

class LocationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider locationProvider
     *
     * @param string $country
     * @param string $city
     */
    public function testIfSetLocationSetsCorrectlyLocation($country, $city)
    {
        $location = new Location();
        $locationString = sprintf('%s, %s', $country, $city);
        $location->setLocation($locationString);

        $this->assertSame($locationString, $location->getLocation());
    }

    /**
     * @dataProvider locationProvider
     *
     * @param string $country
     * @param string $city
     */
    public function testIfSetLocationSetsCorrectlyCityAndCountry($country, $city)
    {
        $location = new Location();
        $locationString = sprintf('%s, %s', $country, $city);
        $location->setLocation($locationString);

        $this->assertSame($country, $location->getCountry());
        $this->assertSame($city, $location->getCity());
    }


    public function locationProvider()
    {
        return [
            ['Poland', 'Katowice'],
            ['Germany', 'Berlin'],
            ['Japan', 'Tokyo'],
        ];
    }
}
