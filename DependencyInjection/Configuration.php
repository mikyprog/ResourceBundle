<?php

/*
 * This file is part of the Miky package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Miky\Bundle\ResourceBundle\DependencyInjection;

use Miky\Bundle\ResourceBundle\MikyResourceBundle;
use Miky\Bundle\ResourceBundle\Controller\ResourceController;
use Miky\Component\Resource\Factory\Factory;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This class contains the configuration information for the bundle.
 *
 * This information is solely responsible for how the different configuration
 * sections are normalized, and merged.
 *
 * @author Paweł Jędrzejewski <pawel@miky.org>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('miky_resource');

        $this->addResourcesSection($rootNode);
        $this->addSettingsSection($rootNode);
        $this->addTranslationsSection($rootNode);

        $rootNode
            ->children()
                ->scalarNode('authorization_checker')
                    ->defaultValue('miky.resource_controller.authorization_checker.disabled')
                    ->cannotBeEmpty()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }

    /**
     * @param ArrayNodeDefinition $node
     */
    private function addResourcesSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('resources')
                    ->useAttributeAsKey('name')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('driver')->defaultValue(MikyResourceBundle::DRIVER_DOCTRINE_ORM)->end()
                            ->variableNode('options')->end()
                            ->scalarNode('templates')->cannotBeEmpty()->end()
                            ->arrayNode('classes')
                                ->isRequired()
                                ->addDefaultsIfNotSet()
                                ->children()
                                    ->scalarNode('model')->isRequired()->cannotBeEmpty()->end()
                                    ->scalarNode('interface')->cannotBeEmpty()->end()
                                    ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                    ->scalarNode('repository')->cannotBeEmpty()->end()
                                    ->scalarNode('factory')->defaultValue(Factory::class)->end()
                                    ->arrayNode('form')
                                        ->prototype('scalar')->end()
                                    ->end()
                                ->end()
                            ->end()
            ->arrayNode('contexts')
            ->useAttributeAsKey('name')
            ->prototype('array')
            ->children()
            ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
            ->end()
            ->end()
            ->end()
                            ->arrayNode('validation_groups')
                                ->addDefaultsIfNotSet()
                                ->children()
                                    ->arrayNode('default')
                                        ->prototype('scalar')->end()
                                        ->defaultValue([])
                                    ->end()
                                ->end()
                            ->end()
                            ->arrayNode('translation')
                                ->children()
                                    ->variableNode('options')->end()
                                    ->arrayNode('classes')
                                        ->isRequired()
                                        ->addDefaultsIfNotSet()
                                        ->children()
                                            ->scalarNode('model')->isRequired()->cannotBeEmpty()->end()
                                            ->scalarNode('interface')->cannotBeEmpty()->end()
                                            ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                            ->scalarNode('repository')->cannotBeEmpty()->end()
                                            ->scalarNode('factory')->defaultValue(Factory::class)->end()
                                            ->arrayNode('form')
                                                ->prototype('scalar')->end()
                                            ->end()
                                        ->end()
                                    ->end()
                                    ->arrayNode('validation_groups')
                                        ->addDefaultsIfNotSet()
                                        ->children()
                                            ->arrayNode('default')
                                                ->prototype('scalar')->end()
                                                ->defaultValue([])
                                            ->end()
                                        ->end()
                                    ->end()
                                    ->arrayNode('fields')
                                        ->prototype('scalar')->end()
                                        ->defaultValue([])
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }

    /**
     * @param $node
     */
    private function addSettingsSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('settings')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->variableNode('paginate')->defaultNull()->end()
                        ->variableNode('limit')->defaultNull()->end()
                        ->arrayNode('allowed_paginate')
                            ->prototype('integer')->end()
                            ->defaultValue([10, 20, 30])
                        ->end()
                        ->integerNode('default_page_size')->defaultValue(10)->end()
                        ->booleanNode('sortable')->defaultFalse()->end()
                        ->variableNode('sorting')->defaultNull()->end()
                        ->booleanNode('filterable')->defaultFalse()->end()
                        ->variableNode('criteria')->defaultNull()->end()
                    ->end()
                ->end()
            ->end()
        ;
    }

    /**
     * @param ArrayNodeDefinition $node
     */
    private function addTranslationsSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('translation')
                    ->canBeEnabled()
                    ->children()
                        ->scalarNode('default_locale')->cannotBeEmpty()->end()
                        ->scalarNode('locale_provider')->defaultValue('miky.translation.locale_provider.request')->cannotBeEmpty()->end()
                        ->scalarNode('available_locales_provider')->defaultValue('miky.translation.locales_provider.array')->cannotBeEmpty()->end()
                        ->arrayNode('available_locales') ->prototype('scalar')->end()
                    ->end()
                ->end()
            ->end()
        ;
    }


}
