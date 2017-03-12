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

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class LeblancSimonEUCookieLawExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('eu_cookie_law.cookie_name', $config['cookie_name']);
        $container->setParameter('eu_cookie_law.cookie_value', $config['cookie_value']);
        $container->setParameter('eu_cookie_law.template', $config['template']);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }
}
