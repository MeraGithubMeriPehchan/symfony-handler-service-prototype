<?php
namespace App\Service;

use App\Factory\OrderFactory;
use App\Repository\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;

class OrderService
{
    public function __construct(
        private OrderFactory $factory,
        private EntityManagerInterface $em,
        private OrderRepository $repo
    ) {}

    public function placeOrder(string $customer, float $amount): int
    {
        $order = $this->factory->create($customer, $amount);
        $this->em->persist($order);
        $this->em->flush();
        return $order->getId();
    }

    public function listOrders(): array
    {
        return $this->repo->findBy([], ['createdAt' => 'DESC'], 20);
    }
}
