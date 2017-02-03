<?php
namespace Dwr\GlobalWeatherBundle\Tests;

use Dwr\GlobalWeatherBundle\Form\LocationChoice;

class LocationChoiceTest extends \PHPUnit_Framework_TestCase
{
    public function testIfLoadChoiceListReturnsSimpleChoiceList()
    {
        $locationChoice = new LocationChoice(array());

        $this->assertInstanceOf(
            'Symfony\Component\Form\Extension\Core\ChoiceList\SimpleChoiceList',
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

        $countCity = 5;
        $this->assertSame($countCity, count($locationChoice->getChoices()));
    }

    public function testIfLoadChoiceListReturnCorrectlyChoiceList()
    {
        $locationParameters = [
            'Test Country1' => ['City1', 'City2'],
            'Test Country2' => ['City3', 'City4', 'City5']
        ];
        $locationChoice = new LocationChoice($locationParameters);

        $expected = [
            'Test Country1, City1',
            'Test Country1, City2',
            'Test Country2, City3',
            'Test Country2, City4',
            'Test Country2, City5',
        ];

        $this->assertSame($expected, $locationChoice->getChoices());
    }
}
