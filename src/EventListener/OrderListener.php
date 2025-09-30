<?php
namespace App\EventListener;

use App\Entity\Order;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Psr\Log\LoggerInterface;

#[AsDoctrineListener(event: Events::postPersist)]
#[AsDoctrineListener(event: Events::postUpdate)]
#[AsDoctrineListener(event: Events::preRemove)]
class OrderListener
{
    public function __construct(private LoggerInterface $logger) {}

    public function postPersist(LifecycleEventArgs $args): void
    {
        if ($args->getObject() instanceof Order) {
            $this->logger->warning("Doctrine Trigger: Order created.");
        }
    }

    public function postUpdate(LifecycleEventArgs $args): void
    {
        if ($args->getObject() instanceof Order) {
            $this->logger->warning("Doctrine Trigger: Order updated.");
        }
    }

    public function preRemove(LifecycleEventArgs $args): void
    {
        if ($args->getObject() instanceof Order) {
            $this->logger->warning("Doctrine Trigger: Order deleted.");
        }
    }
}