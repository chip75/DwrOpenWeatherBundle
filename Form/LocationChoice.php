<?php
namespace Dwr\GlobalWeatherBundle\Form;

use Symfony\Component\Form\Extension\Core\ChoiceList\SimpleChoiceList;
use Symfony\Component\Form\Extension\Core\ChoiceList\LazyChoiceList;

class LocationChoice extends LazyChoiceList
{

    private $locationParameters;

    public function __construct(array $locationParameters)
    {
        $this->locationParameters = $locationParameters;
    }

    /**
     * @return SimpleChoiceList
     */
    public function loadChoiceList()
    {
        $choices = $this->getLocationCities($this->locationParameters);
        return new SimpleChoiceList($choices);
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
