<?php

namespace Dwr\OpenWeatherBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use LogicException;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class DwrOpenWeatherExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $this->setParameters($config, $container);
    }

    private function setParameters(array $config, ContainerBuilder $container)
    {
        if (! array_key_exists('api_key', $config)) {
            throw new LogicException('The child node "api_key" at path "dwr_open_weather" must be configured.');
        }

        $configData = [];
        $configData['api_key'] = $config['api_key'];

        if (isset($config['base_uri'])) {
            $configData['base_uri'] = $config['base_uri'];
        } else {
            $configData['base_uri'] = $container->getParameter('dwr_open_weather')['base_uri'];
        }

        if (isset($config['version'])) {
            $configData['version'] = $config['version'];
        } else {
            $configData['version'] = $container->getParameter('dwr_open_weather')['version'];
        }

        if (isset($config['timeout'])) {
            $configData['timeout'] = $config['timeout'];
        } else {
            $configData['timeout'] = $container->getParameter('dwr_open_weather')['timeout'];
        }

        if (isset($config['supported_request_type'])) {
            $configData['supported_request_type'] = $config['supported_request_type'];
        } else {
            $configData['supported_request_type'] = $container->getParameter('dwr_open_weather')['supported_request_type'];
        }

        $container->setParameter(
            'dwr_open_weather',
            $configData
        );
    }
}
