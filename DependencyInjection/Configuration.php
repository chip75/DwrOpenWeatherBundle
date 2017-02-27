<?php

namespace Dwr\OpenWeatherBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Dwr\OpenWeatherBundle\Service\Configuration as DwrOpenWeatherConfiguration;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('dwr_open_weather');

        $rootNode
            ->children()
                ->scalarNode('api_key')->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('base_uri')->end()
                ->scalarNode('version')->end()
                ->scalarNode('timeout')->end()
                ->arrayNode('supported_request_type')
                    ->children()
                        ->scalarNode('Weather')->defaultValue(DwrOpenWeatherConfiguration::DEFAULT_SUPPORTED_TYPE['Weather'])->end()
                        ->scalarNode('Forecast')->defaultValue(DwrOpenWeatherConfiguration::DEFAULT_SUPPORTED_TYPE['Forecast'])->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
