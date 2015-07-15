<?php
namespace Dwr\GlobalWeatherBundle\WeatherService\Client;

class GlobalWeatherClient
{
    /**
     * @var string
     */
    private $wsdl;

    /**
     * @var integer
     */
    private $timeout;

    /**
     * @param array $configuration
     */
    public function __construct(array $configuration)
    {
        $this->wsdl    = $configuration['wsdl'];
        $this->timeout = $configuration['timeout'];
    }

    /**
     * @return \SoapClient
     * @throws \Exception
     */
    public function connect()
    {
        ini_set('default_socket_timeout', $this->timeout);
        $soapClient = new \SoapClient($this->wsdl, array('exceptions'=> true));

        return $soapClient;
    }
}
