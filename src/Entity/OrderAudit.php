<?php

namespace App\Entity;

use App\Repository\OrderAuditRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderAuditRepository::class)]
class OrderAudit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $orderId = null;

    #[ORM\Column(length: 20)]
    private ?string $action = null;

    #[ORM\Column]
    private ?\DateTime $actionTime = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderId(): ?int
    {
        return $this->orderId;
    }

    public function setOrderId(int $orderId): static
    {
        $this->orderId = $orderId;

        return $this;
    }

    public function getAction(): ?string
    {
        return $this->action;
    }

    public function setAction(string $action): static
    {
        $this->action = $action;

        return $this;
    }

    public function getActionTime(): ?\DateTime
    {
        return $this->actionTime;
    }

    public function setActionTime(\DateTime $actionTime): static
    {
        $this->actionTime = $actionTime;

        return $this;
    }
}
