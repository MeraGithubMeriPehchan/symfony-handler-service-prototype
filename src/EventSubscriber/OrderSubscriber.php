<?php
namespace App\EventSubscriber;

use App\Entity\Order;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use Psr\Log\LoggerInterface;

class OrderSubscriber implements EventSubscriber
{
    public function __construct(private LoggerInterface $logger) {}

    public function getSubscribedEvents(): array
    {
        return [Events::postPersist, Events::preUpdate, Events::preRemove];
    }

    public function postPersist(LifecycleEventArgs $args): void
    {
        if ($args->getObject() instanceof Order) {
            $this->logger->info("Doctrine Trigger: Order created.");
        }
    }

    public function preUpdate(LifecycleEventArgs $args): void
    {
        if ($args->getObject() instanceof Order) {
            $this->logger->info("Doctrine Trigger: Order updated.");
        }
    }

    public function preRemove(LifecycleEventArgs $args): void
    {
        if ($args->getObject() instanceof Order) {
            $this->logger->info("Doctrine Trigger: Order deleted.");
        }
    }
}
