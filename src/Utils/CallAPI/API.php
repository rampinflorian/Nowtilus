<?php

namespace App\Utils\CallAPI;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;


abstract class API
{
    private $client;
    private $hostUrlAPI = "https://easybacapi.herokuapp.com/api/";

    /**
     * API constructor.
     */
    public function __construct()
    {
        $this->client = HttpClient::create();
    }

    /**
     * @param string $verb
     * @param string $url
     * @return ResponseInterface
     * @throws TransportExceptionInterface
     */
    protected function getResponseInterface(string $verb, string $url): ResponseInterface
    {
        return $this->client->request($verb, $this->hostUrlAPI . $url);
    }

    /**
     * @param ResponseInterface $response
     * @throws TransportExceptionInterface
     */
    protected function throwErrorStatusCodeNot200(ResponseInterface $response): void
    {
        throw new \Exception("Erreur lors du {$response->getInfo()["http_method"]} : {$response->getStatusCode()}", $response->getStatusCode());
    }
}