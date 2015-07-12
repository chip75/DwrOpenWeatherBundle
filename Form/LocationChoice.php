<?php
namespace Dwr\GlobalWeatherBundle\Form;

use Symfony\Component\Form\Extension\Core\ChoiceList\SimpleChoiceList,
    Symfony\Component\Form\Extension\Core\ChoiceList\LazyChoiceList,
    Symfony\Component\Yaml\Parser;

class LocationChoice extends LazyChoiceList
{

    public function loadChoiceList ()
    {
        $parser = new Parser();
        $config = $parser->parse(file_get_contents(__DIR__ . '/../Resources/config/services.yml'));
        $locations = $config['parameters']['dwr_global_weather_locations'];
        $choices = $this->getLocationCities($locations);

        return new SimpleChoiceList($choices);
    }

    private function getLocationCities($locations)
    {
        $data = [];
        foreach($locations as $country => $cities)
        {
            foreach ($cities as $city) {
                $data[] = sprintf('%s, %s', $country, $city);
            }
        }

        return $data;
    }

}