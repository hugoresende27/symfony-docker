<?php

namespace App\Services;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class TMDBService
{
    private ParameterBagInterface $parameters;
    private string $baseUrl;
    private string $apiKey;
    public function __construct(ParameterBagInterface $parameters)
    {
        $this->baseUrl = $parameters->get('api.tmdb_base_url');
        $this->apiKey = $parameters->get('api.tmdb_apikey');
    }

    public function getMovies()
    {
        return $this->callApi('3/discover/movie');
    }

    public function getMovieImage(string $imageId)
    {
        return $this->callApi('t/p/original/'.$imageId);
    }



    /**
     * @param string $url
     * @param string $method
     *
     * @return array
     */
    public function callApi(string $url = '/', string $method = 'GET'): array
    {
        try {
            $url = $this->baseUrl.$url."?api_key=".$this->apiKey;
            $client = new Client();
            $request = new Request($method, $url);
            $res = $client->sendAsync($request)->wait();
            $response = json_decode($res->getBody()->getContents(), true);
            return $response;
        } catch (GuzzleException $e) {
            return ['message' => $e->getMessage(), 'code' => $e->getCode()];

        }

    }


}
