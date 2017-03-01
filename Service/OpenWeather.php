<?php

namespace Dwr\OpenWeatherBundle\Service;

use Dwr\OpenWeatherBundle\Factory\ResponseFactory;

class OpenWeather
{
    const DEFAULT_TYPE = 'Weather';

    /**
     * @var Configuration
     */
    private $config;
    /**
     * @var Client
     */
    private $client;

    /**
     * @var string
     */
    private $type;

    /**
     * OpenWeather constructor.
     * @param Configuration $config
     */
    public function __construct(Configuration $config)
    {
        $this->config = $config;
        $this->client = $config->getHttpClient();
        $this->type = self::DEFAULT_TYPE;
    }

    /**
     * @param $type
     * @return $this
     */
    public function setType($type)
    {
        if (! $this->isType($type)) {
            throw new \InvalidArgumentException(
                'Unknown OpenWeather type. Supported types are: ' . implode(', ', array_keys($this->getSupportedType()))
            );
        }

        $this->type = $type;

        return $this;
    }

    /**
     * @param string $type
     * @return bool
     */
    private function isType($type)
    {
        if (isset($type)
            && ! empty($type)
            && array_key_exists($type, $this->getSupportedType())
        ) {
            return true;
        }
        return false;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return array
     */
    public function getSupportedType()
    {
        return $this->config->supportedType();
    }

    /**
     * @param string $cityName
     * @return ResponseInterface
     */
    public function getByCityName($cityName)
    {
        return $this->request(['query' => ['q' => $cityName]]);
    }

    /**
     * @param string $cityId
     * @return ResponseInterface
     */
    public function getByCityId($cityId)
    {
        return $this->request(['query' => ['id' => (int)$cityId]]);
    }

    /**
     * @param int $lat
     * @param int $lon
     * @return ResponseInterface
     */
    public function getByGeographicCoordinates($lon, $lat)
    {
        return $this->request(['query' => ['lon' => $lon, 'lat' => $lat]]);
    }

    /**
     * @param array $parameters
     * @return ResponseInterface
     */
    private function request(array $parameters)
    {
        $parameters['query']['appid'] = $this->config->apiKey();
        $data = $this->client->get($this->buildUri($this->type), $parameters);
        return $this->response($this->type, $data);
    }

    /**
     * @param $requestType
     * @return string
     */
    private function buildUri($requestType)
    {
        $supportedType = $this->config->supportedType();
        return $this->config->version() . $supportedType[$requestType];
    }

    /**
     * @param $responseType
     * @param Response $data
     * @return ResponseInterface
     */
    private function response($responseType, $data)
    {
        $response = new ResponseFactory();
        return $response->setType($responseType)->create($data->getBody());
    }
}
