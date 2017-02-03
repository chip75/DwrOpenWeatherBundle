<?php

namespace Dwr\GlobalWeatherBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('dwr_global_weather');

        $rootNode
            ->children()
                ->arrayNode('dwr_global_weather_configuration')
                    ->children()
                        ->scalarNode('wsdl')->end()
                        ->scalarNode('timeout')->end()
                    ->end()
                ->end() //dwr_global_weather_configuration
                ->arrayNode('dwr_global_weather_locations')
                    ->prototype('array')
                        ->prototype('scalar')
                        ->end()
                    ->end()
                ->end() //dwr_global_weather_locations
            ->end()
        ;

        return $treeBuilder;
    }
}
