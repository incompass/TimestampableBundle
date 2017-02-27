<?php

namespace Incompass\TimestampableBundle\Tests\Entity;

use DateTime;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Incompass\TimestampableBundle\Tests\Stub\TimestampableEntity;

/**
 * Class TimestampableTest
 *
 * @package Incompass\TimestampableBundle\Tests\Entity
 * @author  Joe Mizzi
 */
class TimestampableTest extends TestCase
{
    /**
     * @test
     */
    public function it_has_a_created_at_datetime()
    {
        $timestampableStub = new TimestampableEntity();
        $dateTime = new DateTime();
        $timestampableStub->setCreatedAt($dateTime);
        self::assertEquals($dateTime, $timestampableStub->getCreatedAt());
    }

    /**
     * @test
     */
    public function it_has_an_updated_at_datetime()
    {
        $timestampableStub = new TimestampableEntity();
        $dateTime = new DateTime();
        $timestampableStub->setUpdatedAt($dateTime);
        self::assertEquals($dateTime, $timestampableStub->getUpdatedAt());
    }
}