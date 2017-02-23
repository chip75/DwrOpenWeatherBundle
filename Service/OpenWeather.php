<?php

namespace Dwr\OpenWeatherBundle\Service;

class OpenWeather
{
    const DEFAULT_TYPE = 'Weather';

    /**
     * @var string
     */
    private $type;

    /**
     * @var array
     */
    private $supportedType = ['Weather', 'Forecast'];

    /**
     * OpenWeather constructor.
     * @param Configuration $config
     */
    public function __construct(Configuration $config = null)
    {
        $this->type = self::DEFAULT_TYPE;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        if (! $this->isType($type)) {
            throw new \InvalidArgumentException(
                'Unknown OpenWeather type. Supported types are: ' . implode(', ', $this->supportedType)
            );
        }

        $this->type = $type;
    }

    /**
     * @param string $type
     * @return bool
     */
    private function isType($type)
    {
        if (isset($type)
            && ! empty($type)
            && in_array($type, $this->supportedType)
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
        return $this->supportedType;
    }


    /**
     * @param string $city
     * @return string
     */
    public function getByCityName($city)
    {
        return $city;
    }
}