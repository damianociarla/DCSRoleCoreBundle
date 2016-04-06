<?php

namespace DCS\Role\CoreBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('dcs_role_core');

        $rootNode
            ->children()
                ->scalarNode('provider')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('default_role')
                    ->defaultValue('ROLE_USER')
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}