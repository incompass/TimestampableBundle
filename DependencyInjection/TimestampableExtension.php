<?php

namespace Incompass\TimestampableBundle\DependencyInjection;

use Incompass\TimestampableBundle\EventListener\TimestampableListener;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * Class TimestampableExtension
 *
 * @package Incompass\TimestampableBundle\DependencyInjection
 * @author  Joe Mizzi <joe@casechek.com>
 */
class TimestampableExtension extends Extension
{
    /**
     * @param array $configs
     * @param ContainerBuilder $container
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $definition = new Definition(TimestampableListener::class);
        $definition->addTag('doctrine.event_listener', ['event' => 'onFlush', 'priority' => -9999]);
        $container->setDefinition('timestampable.listener', $definition);
    }
}