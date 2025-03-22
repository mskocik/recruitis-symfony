<?php

namespace App\Controller;

use App\Repository\JobRepository;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class JobController extends AbstractController
{
    #[Route(path: '/{page<\d+|{page}>?1}', name: 'home')]
    public function index(Request $request): Response
    {
        return $this->render('job/index.html.twig', [
            'listing_apiUrl' => $this->generateUrl('api_page', ['page' => '{page}']),
            'listing_detailUrl' => $this->generateUrl('job_detail', ['id' => '{id}', 'slug' => '{slug}']),
            'listing_page' => $request->attributes->getInt('page'),
        ]);
    }

    #[Route(path: '/job/{id<\d+|{id}>}/{slug}', name: 'job_detail')]
    public function detail(Request $request, JobRepository $jobRepository): Response
    {
    }

    /**
     * Enable creating URLs with placeholders.
     *
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     */
    protected function generateUrl(string $route, array $parameters = [], int $referenceType = UrlGeneratorInterface::ABSOLUTE_PATH): string
    {
        $url = urldecode(parent::generateUrl($route, $parameters, $referenceType));

        return $url;
    }
}
