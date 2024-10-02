<?php

namespace App\Controller\Front;

use App\Services\TMDBService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;


#[IsGranted('IS_AUTHENTICATED_FULLY')] // This ensures all methods require full authentication
class MoviesController extends AbstractController
{

    protected TMDBService $tMDBService;

    public function __construct(TMDBService $tMDBService)
    {
        $this->tMDBService = $tMDBService;
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
