<?php
/*
 * ZetaComponents Search Bundle
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to kontakt@beberlei.de so I can send you a copy immediately.
 */

namespace Bundle\ZetaBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

class ZetaExtension extends Extension
{
    /**
     * @param array $config
     * @param BuilderConfiguration $builder
     */
    public function searchLoad($config, ContainerBuilder $builder)
    {
        $loader = new XmlFileLoader($builder, __DIR__.'/../Resources/config');
        $loader->load('zetaSearch.xml');

        foreach (array('solr', 'zendlucene', 'xml-manager') AS $comp) {
            if (isset($config[$comp])) {
                $builder->setParameters($config[$comp]);
            }
        }

        if (isset($config['manager'])) {
            $builder->setAlias('zeta.search.manager', $config['manager']);
        }
        if (isset($config['handler'])) {
            $builder->setAlias('zeta.search.handler', $config['handler']);
        }

        return $builder;
    }

    public function getAlias()
    {
        return 'zeta';
    }

    public function getNamespace()
    {
        return 'http://www.whitewashing.de/schema/zeta/';
    }

    public function getXsdValidationBasePath()
    {
        return false;
    }
}