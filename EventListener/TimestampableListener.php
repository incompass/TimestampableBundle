<?php

namespace Incompass\TimestampableBundle\EventListener;

use Doctrine\ORM\Event\OnFlushEventArgs;
use Incompass\TimestampableBundle\Entity\TimestampInterface;
use Incompass\TimestampableBundle\Entity\TimestampTrait;

/**
 * Class TimestampableListener
 *
 * @package Incompass\TimestampableBundle\EventListener
 * @author  Joe Mizzi <joe@casechek.com>
 */
class TimestampableListener
{
    private static $allowOverride;

    public static function setAllowOverride(bool $allowOverride)
    {
        static::$allowOverride = $allowOverride;
    }

    public static function getAllowOverride(): ?bool
    {
        return static::$allowOverride;
    }

    /**
     * @param OnFlushEventArgs $args
     */
    public function onFlush(OnFlushEventArgs $args)
    {
        $uow = $args->getEntityManager()->getUnitOfWork();

        foreach ($uow->getScheduledEntityInsertions() as $insert) {
            if ($insert instanceof TimestampInterface) {
                /** @var TimestampTrait $update */
                $now = new \DateTime(null, new \DateTimeZone('UTC'));
                $insert->setCreatedAt(($insert->getCreatedAt() && static::$allowOverride) ? $insert->getCreatedAt() : $now);
                $insert->setUpdatedAt(($insert->getCreatedAt() && static::$allowOverride) ? $insert->getCreatedAt() : $now);
                $uow->recomputeSingleEntityChangeSet(
                    $args->getEntityManager()->getClassMetadata(get_class($insert)),
                    $insert
                );
            }
        }

        foreach ($uow->getScheduledEntityUpdates() as $update) {
            if ($update instanceof TimestampInterface) {
                /** @var TimestampTrait $update */
                $now = new \DateTime(null, new \DateTimeZone('UTC'));
                $update->setUpdatedAt($now);
                $uow->recomputeSingleEntityChangeSet(
                    $args->getEntityManager()->getClassMetadata(get_class($update)),
                    $update
                );
            }
        }
    }
}