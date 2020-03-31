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
    private const PATHURL = 'water_qualities';
    /**
     * API_waterQualities constructor.
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer)
    {
        parent::__construct($serializer);
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
        $response = $this->getResponseInterface('GET', self::PATHURL);
        if ($response->getStatusCode() == 200) {
            $datas = [];
            foreach ($response->toArray()["hydra:member"] as $value) {
                $datas[] = $this->serializer->deserialize(json_encode($value), WaterQuality::class, 'json');
            }
            return $datas;
        } else {
            $this->throwErrorStatusCodeNot200($response);
        }
    }

    /**
     * @param int $id
     * @return WaterQuality|array|object|null
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function find(int $id): WaterQuality
    {
        $response = $this->getResponseInterface('GET', self::PATHURL . '/' . $id);
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
        $response = $this->getResponseInterface('DELETE', self::PATHURL . '/' . $id);

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
        $this->postResponseInterface($waterQuality, self::PATHURL);
    }

    /**
     * @param WaterQuality $waterQuality
     * @throws TransportExceptionInterface
     */
    public function put(WaterQuality $waterQuality): void
    {
        $this->putResponseInterface($waterQuality, self::PATHURL . '/' . $waterQuality->getId());
    }
}