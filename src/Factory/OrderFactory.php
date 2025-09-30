<?php
namespace App\Factory;

use App\Entity\Order;

class OrderFactory
{
    public function create(string $customerName, float $amount): Order
    {
        $order = new Order();
        $order->setCustomerName($customerName);
        $order->setAmount(number_format($amount, 2, '.', ''));
        $order->setCreatedAt(new \DateTimeImmutable());
        return $order;
    }
}