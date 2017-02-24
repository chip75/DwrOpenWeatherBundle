<?php

namespace Dwr\OpenWeatherBundle\Service;

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
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {


//        if (! $container->has('dwr_open_weather')) {
//            throw new \LogicException('The DwrOpenWeatherBundle is not registered in your application.');
//        }

        $apiKey="123";

        $this->baseUri = self::DEFAULT_BASE_URI;
        $this->version = self::DEFAULT_VERSION;
        $this->timeout = self::DEFAULT_TIMEOUT;
        $this->httpClient = $this->getHttpClient();
        $this->apiKey = $apiKey;
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
