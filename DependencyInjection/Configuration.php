<?php

/*
 * This file is part of the EUCookieLawBundle package.
 *
 * (c) Leblanc Simon <https://www.leblanc-simon.fr/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LeblancSimon\EUCookieLawBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $tree_builder = new TreeBuilder();
        $root_node = $tree_builder->root('eu_cookie_law');

        $root_node
            ->children()
                ->scalarNode('cookie_name')
                    ->defaultValue('eu_cookie_law')
                ->end()
                ->scalarNode('cookie_value')
                    ->defaultValue('accept')
                ->end()
                ->scalarNode('cookie_value')
                    ->defaultValue('accept')
                ->end()
                ->scalarNode('read_more_link')
                    ->defaultValue(null)
                ->end()
                ->scalarNode('template')
                    ->defaultValue('LeblancSimonEUCookieLawBundle::eu_cookie_law.html.twig')
                ->end()
            ->end()
        ;

        return $tree_builder;
    }
}
