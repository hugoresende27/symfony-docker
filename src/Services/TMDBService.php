<?php

namespace App\Services;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class TMDBService
{
    private ParameterBagInterface $params;
    private string $baseUrl;
    private string $apiKey;
    public function __construct(ParameterBagInterface $params)
    {
        $this->baseUrl = $params->get("api.tmdb_base_url");
        $this->apiKey = $params->get("api.tmdb_apikey");
    }



    public function getMovies()
    {
        return $this->callApi('3/discover/movie');
    }



    public function callApi(string $url, string $method = 'GET')
    {
        try {
            $url = $this->baseUrl . $url ."?api_key=".$this->apiKey;
            $client = new Client();
            $request = new Request($method, $url);
            $response = $client->send($request);
            $decodedResponse = json_decode($response->getBody()->getContents(), true);
            return $decodedResponse;
        } catch (GuzzleException $e) {
            return ['message' => $e->getMessage(), 'code' => $e->getCode()];
        }
    }
}
