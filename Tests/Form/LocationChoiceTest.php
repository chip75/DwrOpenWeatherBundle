<?php
namespace Dwr\GlobalWeatherBundle\Tests;

use Dwr\GlobalWeatherBundle\Form\LocationChoice;

class LocationChoiceTest extends \PHPUnit_Framework_TestCase
{
    public function testIfLoadChoiceListReturnsArrayChoiceList()
    {
        $locationChoice = new LocationChoice(array());

        $this->assertInstanceOf(
            'Symfony\Component\Form\ChoiceList\ArrayChoiceList',
            $locationChoice->loadChoiceList()
        );
    }

    public function testIfLoadChoiceListReturnCorrectlyAmountOfChoiceListElement()
    {
        $locationParameters = [
            'Test Country1' => ['City1', 'City2'],
            'Test Country2' => ['City3', 'City4', 'City5']
        ];
        $locationChoice = new LocationChoice($locationParameters);
        $loadedChoices = $locationChoice->loadChoiceList();
        $countCity = 5;

        $this->assertSame($countCity, count($loadedChoices->getChoices()));
    }

    public function testIfLoadChoiceListReturnCorrectlyChoiceList()
    {
        $locationParameters = [
            'Test Country1' => ['City1', 'City2'],
            'Test Country2' => ['City3', 'City4', 'City5']
        ];
        $locationChoice = new LocationChoice($locationParameters);
        $loadedChoices = $locationChoice->loadChoiceList();

        $expected = [
            'Test Country1, City1',
            'Test Country1, City2',
            'Test Country2, City3',
            'Test Country2, City4',
            'Test Country2, City5',
        ];

        $this->assertSame($expected, $loadedChoices->getValues());
    }
}
