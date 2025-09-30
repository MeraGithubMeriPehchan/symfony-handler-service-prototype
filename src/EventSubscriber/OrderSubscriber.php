<?php
namespace App\EventSubscriber;

use App\Entity\Order;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\PostPersistEventArgs;
use Doctrine\ORM\Event\PostUpdateEventArgs;
use Doctrine\ORM\Event\PreRemoveEventArgs;
use Doctrine\ORM\Events;
use Psr\Log\LoggerInterface;

class OrderSubscriber implements EventSubscriber
{
    public function __construct(private LoggerInterface $logger) {}

    public function getSubscribedEvents(): array
    {
        return [Events::postPersist, Events::postUpdate, Events::preRemove];
    }

    public function postPersist(PostPersistEventArgs $args): void
    {
        if ($args->getObject() instanceof Order) {
            $this->logger->info("Doctrine Trigger: Order created.");
        }
    }

    public function postUpdate(PostUpdateEventArgs $args): void
    {
        if ($args->getObject() instanceof Order) {
            $this->logger->info("Doctrine Trigger: Order updated.");
        }
    }

    public function preRemove(PreRemoveEventArgs $args): void
    {
        if ($args->getObject() instanceof Order) {
            $this->logger->info("Doctrine Trigger: Order deleted.");
        }
    }
}
