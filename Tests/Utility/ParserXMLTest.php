<?php
namespace Dwr\GlobalWeatherBundle\Tests;

use Dwr\GlobalWeatherBundle\Utility\ParserXML;

class ParserXMLTest extends \PHPUnit_Framework_TestCase
{
    private $xmlStringCorrect;
    private $xmlStringDemaged;

    public function setUp()
    {
        $this->xmlStringCorrect = '<?xml version="1.0" encoding="utf-16"?>
                                        <CurrentWeather>
                                            <Location>Katowice, Poland (EPKT) 50-14N 019-02E 284M</Location>
                                            <Temperature> 62 F (17 C)</Temperature>
                                        </CurrentWeather>';

        $this->xmlStringDemaged = '<?xml version="1.0" encoding="utf-16"?>
                                        <CurrentWeather>
                                            <Location>Katowice, Poland (EPKT) 50-14N 019-02E 284M';
    }


    public function testIfParseXMLReturnsSimpleXMLElement()
    {
        $parserXML = new ParserXML();
        $simpleXmlObject = $parserXML->parseXML($this->xmlStringCorrect);

        $this->assertInstanceOf('SimpleXMLElement', $simpleXmlObject);
    }

    public function testIfParseXMLReturnsObjectWithCorrectedAttributes()
    {
        $parserXML = new ParserXML();
        $obj = $parserXML->parseXML($this->xmlStringCorrect);

        $this->assertObjectHasAttribute('Location', $obj);
        $this->assertObjectHasAttribute('Temperature', $obj);
    }

    public function testIfParseXMLReturnsFalseWhenXmlWithErrors()
    {
        $parserXML = new ParserXML();
        $result = $parserXML->parseXML($this->xmlStringDemaged);

        $this->assertSame(false, $result);
    }

    public function testIfGetErrorsReturnsArrayWithErrorsForDemagedXml()
    {
        $parserXML = new ParserXML();
        $parserXML->parseXML($this->xmlStringDemaged);

        $this->assertNotEmpty($parserXML->getErrors());
    }

    public function testIfGetErrorsReturnsNoErrorForCorrectedXml()
    {
        $parserXML = new ParserXML();
        $parserXML->parseXML($this->xmlStringCorrect);

        $this->assertEmpty($parserXML->getErrors());
    }
}
