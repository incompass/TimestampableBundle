<?php

namespace Incompass\TimestampableBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class TimestampableExtension
 *
 * @package Incompass\TimestampableBundle\DependencyInjection
 * @author  Joe Mizzi <joe@casechek.com>
 */
class TimestampableExtension extends Extension implements PrependExtensionInterface
{
    /**
     * @param array $configs
     * @param ContainerBuilder $container
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__ . '/../Resources/config')
        );
        $loader->load('services.yml');
    }

    /**
     * @param ContainerBuilder $container
     */
    public function prepend(ContainerBuilder $container)
    {
        $env = $container->getParameter('kernel.environment');
        if ($env == 'test') {
            $container->prependExtensionConfig('doctrine', [
                    'dbal' => [
                        'connections' => [
                            'timestampable_test' => [
                                'driver' => 'pdo_sqlite',
                                'memory' => true
                            ]
                        ]
                    ],
                    'orm' => [
                        'entity_managers' => [
                            'timestampable_test' => [
                                'connection' => 'timestampable_test',
                                'mappings' => [
                                    'TimestampableBundle' => [
                                        'type' => 'annotation',
                                        'dir' => 'Tests/Stub',
                                        'is_bundle' => true,
                                        'prefix' => 'Incompass\TimestampableBundle'
                                    ]
                                ]
                            ]
                        ]
                    ]
            ]);
        }

    }
}