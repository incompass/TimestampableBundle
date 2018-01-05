<?php

namespace Incompass\TimestampableBundle\Tests;

use Incompass\TimestampableBundle\DependencyInjection\TimestampableExtension;
use Incompass\TimestampableBundle\EventListener\TimestampableSubscriber;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class TimestampableExtensionTest
 *
 * @package Incompass\TimestampableBundle\Tests
 * @author  Joe Mizzi <joe@casechek.com>
 */
class TimestampableExtensionTest extends TestCase
{
    /**
     * @test
     */
    public function it_adds_the_subscriber_service()
    {
        $extension = new TimestampableExtension();
        $container = new ContainerBuilder();
        $container->registerExtension($extension);
        $container->loadFromExtension('timestampable');
        $container->compile();
        self::assertInstanceOf(TimestampableSubscriber::class, $container->get('timestampable.listener'));
    }
}