<?php
namespace App\Controller;

use App\Handler\OrderHandler;
use App\Service\OrderService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    #[Route('/orders', methods: ['POST'])]
    public function create(Request $request, OrderHandler $handler): JsonResponse
    {
        $data = $request->toArray();
        $id = $handler->handleCreateOrder($data['customerName'], $data['amount']);
        return $this->json(['orderId' => $id], 201);
    }

    #[Route('/orders', methods: ['GET'])]
    public function list(OrderService $service): JsonResponse
    {
        $orders = $service->listOrders();
        return $this->json(array_map(fn($o) => [
            'id' => $o->getId(),
            'customer' => $o->getCustomerName(),
            'amount' => $o->getAmount(),
            'createdAt' => $o->getCreatedAt()->format('c'),
        ], $orders));
    }
}
