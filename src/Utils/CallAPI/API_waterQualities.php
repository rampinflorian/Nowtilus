<?php

namespace App\Utils\CallAPI;

use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class API_waterQualities extends API
{


    /**
     * @return array
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     * @throws \Exception
     */
    public function findAll(): array
    {
        $response = $this->getResponseInterface('GET', 'water_qualities');
        if ($response->getStatusCode() == 200) {
            return $response->toArray();
        } else {
            $this->throwErrorStatusCodeNot200($response);
        }
    }

    /**
     * @param int $id
     * @return array
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function find(int $id): array
    {
        $response = $this->getResponseInterface('GET', 'water_qualities/' . $id);
        if ($response->getStatusCode() == 200) {
            return $response->toArray();
        } else {
            $this->throwErrorStatusCodeNot200($response);
        }
    }

    /**
     * @param int $id
     * @return bool
     * @throws TransportExceptionInterface
     */
    public function delete(int $id): bool
    {
        $response = $this->getResponseInterface('DELETE', "water_qualities/" . $id);

        if ($response->getStatusCode() == 204) {
            return true;
        } else {
            $this->throwErrorStatusCodeNot200($response);
        }
    }
}