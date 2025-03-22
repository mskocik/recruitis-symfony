<?php

namespace App\Controller\Api;

use App\Repository\FormRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class JobFormController extends AbstractController
{
    #[Route(path: '/api/form/{id<\d+|{id}>}', name: 'api_jobForm', methods: ['GET', 'POST'])]
    public function getDefinition(int $id, Request $request, FormRepository $formRepository): JsonResponse
    {
        if ('GET' === $request->getMethod()) {
            $payload = $formRepository->getDefinitonByJob($id);
            return new JsonResponse(
                data: $payload,
                status: $payload->fields ? 200 : 404
            );
        }
        
        return $this->handlePost(...func_get_args());
    }

    public function handlePost(int $id, Request $request, FormRepository $formRepository): JsonResponse
    {
        return new JsonResponse();
    }
}
