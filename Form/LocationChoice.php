<?php
namespace Dwr\GlobalWeatherBundle\Form;

use Symfony\Component\Form\Extension\Core\ChoiceList\SimpleChoiceList;
use Symfony\Component\Form\Extension\Core\ChoiceList\LazyChoiceList;
use Symfony\Component\Yaml\Parser;

class LocationChoice extends LazyChoiceList
{
    /**
     * @return SimpleChoiceList
     */
    public function loadChoiceList()
    {
        $parser    = new Parser();
        $config    = $parser->parse(file_get_contents(__DIR__ . '/../Resources/config/services.yml'));
        $locations = $config['parameters']['dwr_global_weather_locations'];
        $choices   = $this->getLocationCities($locations);

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
