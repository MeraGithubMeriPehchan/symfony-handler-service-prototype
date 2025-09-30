<?php
namespace App\Controller;

use App\Repository\OrderAuditRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class AuditController extends AbstractController
{
    #[Route('/orders/audit', methods: ['GET'])]
    public function index(OrderAuditRepository $repo): JsonResponse
    {
        $audits = $repo->findBy([], ['actionTime' => 'DESC'], 50);

        return $this->json(array_map(fn($a) => [
            'id' => $a->getId(),
            'orderId' => $a->getOrderId(),
            'action' => $a->getAction(),
            'actionTime' => $a->getActionTime()->format('c'),
        ], $audits));
    }
}
