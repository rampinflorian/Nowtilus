<?php


namespace App\Service\API;


use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

abstract class DefaultAPIService
{
    private HttpClientInterface $client;
    protected string $host = "";
    protected SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer, $host)
    {
        $this->client = HttpClient::create([
            'headers' => [
                'Content-Type' => 'application/json'
            ]
        ]);
        $this->host = $host;
        $this->serializer = $serializer;
    }

    /**
     * @param string $verb
     * @param string $url
     * @return ResponseInterface
     * @throws TransportExceptionInterface
     */
    protected function getResponseInterface(string $verb, string $url): ResponseInterface
    {
        return $this->client->request($verb, $this->host . $url);
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
        return $this->client->request('POST', $this->host . $url, [
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
        return $this->client->request('PUT', $this->host . $url, [
            'body' => $serialise
        ]);
    }

    protected function setHost(string $host) : void
    {
        $this->host = $host;
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