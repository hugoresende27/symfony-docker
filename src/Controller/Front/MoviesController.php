<?php

namespace App\Controller\Front;

use App\Services\TMDBService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MoviesController extends AbstractController
{

    private TMDBService $tMDBService;
    public function __construct(TMDBService $TMDBService)
    {
        $this->tMDBService = $TMDBService;
    }
    #[Route('/movies', name: 'app_front_movies')]
    public function index(): Response
    {
        $movies = $this->tMDBService->getMovies();
        return $this->render('front/movies/index.html.twig', [
            'movies' => $movies['results'] ?? [],
        ]);
    }
}
