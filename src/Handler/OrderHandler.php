<?php
namespace App\Handler;

use App\Service\OrderService;

class OrderHandler
{
    public function __construct(private OrderService $orderService) {}

    public function handleCreateOrder(string $customer, float $amount): int
    {
        return $this->orderService->placeOrder($customer, $amount);
    }
}
