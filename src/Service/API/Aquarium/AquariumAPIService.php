<?php

namespace App\Service\API\Aquarium;

use App\Service\API\Aquarium\Entity\WaterQuality;
use App\Service\API\DefaultAPIService;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;


abstract class AquariumAPIService extends DefaultAPIService
{
    private HttpClientInterface $client;
    protected SerializerInterface $serializer;

    /**
     * AquariumAPIService constructor.
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer)
    {
        parent::__construct($serializer, "https://easybacapi.herokuapp.com/api/");
    }
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


}