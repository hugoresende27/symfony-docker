<?php

namespace App\Controller\API;

use App\Services\TMDBService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TMDBAPIController extends AbstractController
{

    private TMDBService $tMDBService;


    public function __construct(TMDBService $tMDBService)
    {
        $this->tMDBService = $tMDBService;
    }


    #[Route(path: 'api/v1/tmdb', name: 'api_tmdb_index')]
    public function index(): JsonResponse
    {
        $apiRequest = $this->tMDBService->getMovies();
        if (!isset($apiRequest['results'])) {
            return new JsonResponse($apiRequest);
        }
        return new JsonResponse($apiRequest['results']);
    }
}
