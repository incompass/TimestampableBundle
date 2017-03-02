<?php

namespace Incompass\TimestampableBundle\DependencyInjection;

use Incompass\TimestampableBundle\EventListener\TimestampableSubscriber;
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
        $definition = new Definition(TimestampableSubscriber::class);
        $definition->addTag('doctrine.event_subscriber');
        $container->setDefinition('timestampable.subscriber', $definition);
    }
}