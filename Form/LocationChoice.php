<?php
namespace Dwr\GlobalWeatherBundle\Form;

use Symfony\Component\Form\ChoiceList\ArrayChoiceList;

class LocationChoice
{

    private $locationParameters;

    public function __construct(array $locationParameters)
    {
        $this->locationParameters = $locationParameters;
    }

    /**
     * @return ArrayChoiceList
     */
    public function loadChoiceList()
    {
        $choices = $this->getLocationCities($this->locationParameters);
        return new ArrayChoiceList($choices);
    }

    /**
     * @param $locations
     * @return array
     */
    private function getLocationCities($locations)
    {
        $data = [];
        foreach ($locations as $country => $cities) {
            foreach ($cities as $city) {
                $location = sprintf('%s, %s', $country, $city);
                $data[$location] = $location;
            }
        }

        return $data;
    }
}
