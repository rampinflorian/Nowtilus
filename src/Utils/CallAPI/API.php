<?php

namespace App\Utils\CallAPI;

use App\Utils\CallAPI\Entity\WaterQuality;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;


abstract class API
{
    private HttpClientInterface $client;
    private string $hostUrlAPI = "https://easybacapi.herokuapp.com/api/";
    protected SerializerInterface $serializer;

    /**
     * API constructor.
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer)
    {
        $this->client = HttpClient::create([
            'headers' => [
                'Content-Type' => 'application/json'
            ]
        ]);
        $this->serializer = $serializer;
    }

    /**
     * @return mixed
     */
    abstract public function findAll();

    /**
     * @param int $id
     * @return mixed
     */
    abstract public function find(int $id);

    /**
     * @param int $id
     * @return mixed
     */
    abstract public function delete(int $id);

    /**
     * @param WaterQuality $waterQuality
     * @return mixed
     */
    abstract public function post(WaterQuality $waterQuality);

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
     * @param Object $object
     * @param string $url
     * @return ResponseInterface
     * @throws TransportExceptionInterface
     */
    protected function postResponseInterface(Object $object, string $url): ResponseInterface
    {
        $serialise = $this->serializer->serialize($object, 'json');
        return $this->client->request('POST', $this->hostUrlAPI . $url, [
            'body' => $serialise
        ]);
    }

    /**
     * @param Object $object
     * @param string $url
     * @return ResponseInterface
     * @throws TransportExceptionInterface
     */
    protected function putResponseInterface(Object $object, string $url): ResponseInterface
    {
        $serialise = $this->serializer->serialize($object, 'json');
        return $this->client->request('PUT', $this->hostUrlAPI . $url, [
            'body' => $serialise
        ]);
    }

    /**
     * @param ResponseInterface $response
     * @throws TransportExceptionInterface
     * @throws \Exception
     */
    protected function throwErrorStatusCodeNot200(ResponseInterface $response): void
    {
        throw new \Exception("Erreur lors du {$response->getInfo()["http_method"]} : {$response->getStatusCode()}", $response->getStatusCode());
    }
}