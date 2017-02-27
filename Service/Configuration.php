<?php

namespace Dwr\OpenWeatherBundle\Service;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;

class Configuration
{
    const DEFAULT_BASE_URI = 'http://api.openweathermap.org';
    const DEFAULT_VERSION = '/data/2.5';
    const DEFAULT_TIMEOUT = '3.0';
    const DEFAULT_SUPPORTED_TYPE = array('Weather' => '/weather', 'Forecast' => '/forecast');

    /**
     * @var string
     */
    private $baseUri;

    /**
     * @var string
     */
    private $version;

    /**
     * @var string
     */
    private $timeout;

    /**
     * HTTP Client
     */
    private $httpClient;

    /**
     * @var array
     */
    private $supportedType;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * Configuration constructor.
     * @param array $configuration
     */
    public function __construct($configuration)
    {
        $this->apiKey = $configuration['api_key'];
        $this->baseUri = (isset($configuration['base_uri']))?$configuration['base_uri']:self::DEFAULT_BASE_URI;
        $this->version = (isset($configuration['version']))?$configuration['version']:self::DEFAULT_VERSION;
        $this->timeout = (isset($configuration['timeout']))?$configuration['timeout']:self::DEFAULT_TIMEOUT;
        $this->supportedType = (isset($configuration['supported_request_type']))?$configuration['supported_request_type']:self::DEFAULT_SUPPORTED_TYPE;
        $this->httpClient = $this->getHttpClient();
    }

    /**
     * @return string
     */
    public function baseUri()
    {
        return $this->baseUri;
    }

    /**
     * @param string $baseUri
     */
    public function setBaseUri($baseUri)
    {
        $this->baseUri = $baseUri;
    }

    /**
     * @return string
     */
    public function version()
    {
        return $this->version;
    }

    /**
     * @param string $version
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }

    /**
     * @return string
     */
    public function timeout()
    {
        return $this->timeout;
    }

    /**
     * @param string $timeout
     */
    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;
    }

    /**
     * @param ClientInterface $httpClient
     */
    public function setHttpClient(ClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @return Client
     */
    public function getHttpClient()
    {
        if ($this->httpClient) {
            return $this->httpClient;
        }
        return $this->httpClient = $this->setDefaultHttpClient();
    }

    /**
     * @return Client
     */
    private function setDefaultHttpClient()
    {
        return new Client([
            'base_uri' => self::DEFAULT_BASE_URI,
            'timeout' => self::DEFAULT_TIMEOUT
        ]);
    }

    public function supportedType()
    {
        return $this->supportedType;
    }

    /**
     * @return string
     */
    public function apiKey()
    {
        return $this->apiKey;
    }
}
