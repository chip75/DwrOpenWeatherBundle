<?php

namespace Dwr\GlobalWeatherBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class DwrGlobalWeatherExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $this->setParameters($config, $container);
    }

    /**
     * @param array $configs
     * @param ContainerBuilder $container
     */
    private function setParameters(array $config, ContainerBuilder $container)
    {
        if (isset($config['dwr_global_weather_locations'])) {
            $container->setParameter(
                'dwr_global_weather_locations',
                $config['dwr_global_weather_locations']
            );
        }

        if (isset($config['dwr_global_weather_configuration'])) {
            $configData = array();

            if (isset($config['dwr_global_weather_configuration']['wsdl'])) {
                $configData['wsdl'] = $config['dwr_global_weather_configuration']['wsdl'];
            } else {
                $configData['wsdl'] = $container->getParameter('dwr_global_weather_configuration')['wsdl'];
            }

            if (isset($config['dwr_global_weather_configuration']['timeout'])) {
                $configData['timeout'] = $config['dwr_global_weather_configuration']['timeout'];
            } else {
                $configData['timeout'] = $container->getParameter('dwr_global_weather_configuration')['timeout'];
            }

            $container->setParameter(
                'dwr_global_weather_configuration',
                $configData
            );
        }
    }
}
