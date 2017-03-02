<?php

namespace Incompass\TimestampableBundle\Tests\EventListener;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Output\NullOutput;
use Incompass\TimestampableBundle\Tests\Stub\TimestampableEntity;

/**
 * Class TimestampableListenerTest
 *
 * @package Incompass\TimestampableBundle\Tests\EventListener
 * @author  Joe Mizzi <joe@casechek.com>
 */
class TimestampableListenerTest extends KernelTestCase
{
    public function setUp()
    {
        parent::setUp();
        self::bootKernel();
        $application = new Application(self::$kernel);
        $application->setAutoExit(false);
        $application->run(new StringInput('doctrine:schema:update --force --env=test --em=timestampable_test'), new NullOutput());
    }

    /**
     * @test
     */
    public function it_adds_created_and_updated_timestamps_to_inserted_entity()
    {
        $stub = new TimestampableEntity();
        $manager = self::$kernel->getContainer()->get('doctrine')->getManager('timestampable_test');
        $manager->persist($stub);
        $manager->flush();
        $results = $manager->getRepository(TimestampableEntity::class)->findAll();
        /** @var TimestampableEntity $stub */
        $stub = $results[0];
        self::assertNotNull($stub->getCreatedAt());
        self::assertNotNull($stub->getUpdatedAt());
    }

    /**
     * @test
     */
    public function it_adds_an_updated_timestamp_to_updated_entities()
    {
        $stub = new TimestampableEntity();
        $manager = self::$kernel->getContainer()->get('doctrine')->getManager('timestampable_test');
        $manager->persist($stub);
        $manager->flush();
        $results = $manager->getRepository(TimestampableEntity::class)->findAll();
        /** @var TimestampableEntity $stub */
        $stub = $results[0];
        sleep(1);
        $stub->setField('updated');
        $manager = self::$kernel->getContainer()->get('doctrine')->getManager('timestampable_test');
        $manager->persist($stub);
        $manager->flush();
        self::assertNotEquals($stub->getCreatedAt(), $stub->getUpdatedAt());
    }
}