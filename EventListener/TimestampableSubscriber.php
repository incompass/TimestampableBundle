<?php

namespace Incompass\TimestampableBundle\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\Event\PreFlushEventArgs;
use Incompass\TimestampableBundle\Entity\Timestampable;

/**
 * Class TimestampableListener
 *
 * @package Incompass\TimestampableBundle\EventListener
 * @author  Joe Mizzi <joe@casechek.com>
 */
class TimestampableSubscriber implements EventSubscriber
{
    /**
     * @return array
     */
    public function getSubscribedEvents()
    {
        return array(
            'preFlush',
            'onFlush',
        );
    }

    /**
     * @param PreFlushEventArgs $args
     */
    public function preFlush(PreFlushEventArgs $args)
    {
        $uow = $args->getEntityManager()->getUnitOfWork();

        foreach ($uow->getScheduledEntityInsertions() as $insertion) {
            if (in_array(Timestampable::class, class_uses($insertion))) {
                /** @var Timestampable $insertion */
                $now = new \DateTime(null, new \DateTimeZone('UTC'));
                $insertion->setCreatedAt($now);
                $insertion->setUpdatedAt($now);
            }
        }
    }

    /**
     * @param OnFlushEventArgs $args
     */
    public function onFlush(OnFlushEventArgs $args)
    {
        $uow = $args->getEntityManager()->getUnitOfWork();

        foreach ($uow->getScheduledEntityUpdates() as $update) {
            if (in_array(Timestampable::class, class_uses($update))) {
                /** @var Timestampable $update */
                $now = new \DateTime(null, new \DateTimeZone('UTC'));
                $update->setUpdatedAt($now);
            }
        }
    }
}