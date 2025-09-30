<?php
namespace App\Factory;

use App\Entity\Order;

class OrderFactory
{
    public function create(string $customerName, float $amount): Order
    {
        return new Order($customerName, number_format($amount, 2, '.', ''));
        
    }
}