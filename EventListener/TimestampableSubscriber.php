<?php

namespace Incompass\TimestampableBundle\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\Event\PreFlushEventArgs;
use Incompass\TimestampableBundle\Entity\TimestampTrait;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\DependencyInjection\ContainerInterface;

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
            'onFlush',
        );
    }

    /**
     * @param OnFlushEventArgs $args
     */
    public function onFlush(OnFlushEventArgs $args)
    {
        $uow = $args->getEntityManager()->getUnitOfWork();

        foreach ($uow->getScheduledEntityInsertions() as $insert) {
            if (in_array(TimestampTrait::class, class_uses($insert))) {
                /** @var TimestampTrait $update */
                $now = new \DateTime(null, new \DateTimeZone('UTC'));
                $insert->setCreatedAt($now);
                $insert->setUpdatedAt($now);
                $uow->recomputeSingleEntityChangeSet(
                    $args->getEntityManager()->getClassMetadata(get_class($insert)),
                    $insert
                );
            }
        }

        foreach ($uow->getScheduledEntityUpdates() as $update) {
            if (in_array(TimestampTrait::class, class_uses($update))) {
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
