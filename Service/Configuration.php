<?php

namespace Dwr\OpenWeatherBundle\Service;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;

class Configuration
{
    const DEFAULT_BASE_URI = 'http://api.openweathermap.org';
    const DEFAULT_VERSION = '/data/2.5';
    const DEFAULT_TIMEOUT = '3.0';

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
     * @var string
     */
    private $apiKey;

    /**
     * Configuration constructor.
     * @param array $configuration
     */
    public function __construct($configuration)
    {
        var_dump($configuration);
        die(__FILE__ . '::' . __LINE__);



        $this->apiKey = $configuration['api_key'];

        $this->baseUri = (isset($configuration['base_uri']))?$configuration['base_uri']:self::DEFAULT_BASE_URI;
        $this->version = (isset($configuration['version']))?$configuration['version']:self::DEFAULT_VERSION;
        $this->timeout = (isset($configuration['timeout']))?$configuration['timeout']:self::DEFAULT_TIMEOUT;
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

    /**
     * @return string
     */
    public function apiKey()
    {
        return $this->apiKey;
    }
}
