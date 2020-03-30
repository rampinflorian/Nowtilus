<?php

namespace App\Utils\CallAPI;


use App\Utils\CallAPI\Entity\WaterQuality;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class API_waterQualities extends API
{
    /**
     * API_waterQualities constructor.
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer)
    {
        parent::__construct($serializer);
        $this->pathUrl = "water_qualities";
    }

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
        $response = $this->getResponseInterface('GET', $this->pathUrl);
        if ($response->getStatusCode() == 200) {
            $arrayResponse = $response->toArray();

            dd($arrayResponse);
            $waterQualities = [];
            foreach ($arrayResponse["hydra:member"] as $wq) {
                $waterQualities[] = $this->serializer->deserialize($wq, WaterQuality::class, 'array');
            }

            return $waterQualities;
        } else {
            $this->throwErrorStatusCodeNot200($response);
        }
    }

    /**
     * @param int $id
     * @return array
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function find(int $id): WaterQuality
    {
        $response = $this->getResponseInterface('GET', $this->pathUrl . '/' . $id);
        if ($response->getStatusCode() == 200) {
            return $this->serializer->deserialize($response->getContent(), WaterQuality::class, 'json');
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
        $response = $this->getResponseInterface('DELETE', $this->pathUrl . '/' . $id);

        if ($response->getStatusCode() == 204) {
            return true;
        } else {
            $this->throwErrorStatusCodeNot200($response);
            return false;
        }
    }

    /**
     * @param WaterQuality $waterQuality
     * @throws TransportExceptionInterface
     */
    public function post(WaterQuality $waterQuality): void
    {
        $request = $this->postResponseInterface($waterQuality, "water_qualities");
    }
}