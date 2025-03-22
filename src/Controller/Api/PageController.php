<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Repository\JobRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    #[Route(path: '/api/page/{page<\d+|{page}>?1}', name: 'api_page')]
    public function __invoke(Request $request, JobRepository $jobRepository): JsonResponse
    {
        $page = $request->attributes->getInt('page', 1);
        $response = $jobRepository->findAllOnPage($page);

        return new JsonResponse($response, 200);
    }
}
