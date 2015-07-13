<?php
namespace Dwr\GlobalWeatherBundle\Utility;

class ParserXML
{
    private $errors = array();

    public function parseXML($xmlString)
    {
        libxml_use_internal_errors(true);
        $xml = simplexml_load_string($this->xml16To8Utf($xmlString));

        if ($this->isValid($xml)) {
            return $xml;
        }
        return false;
    }

    public function isValid($xml)
    {
        if (false === $xml) {
            foreach (libxml_get_errors() as $error) {
                $this->errors[] = $error->message;
            }
            return false;
        }
        return true;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    private function xml16To8Utf($xml)
    {
        return preg_replace('/(<\?xml[^?]+?)utf-16/i', '$1utf-8', $xml);
    }
}
