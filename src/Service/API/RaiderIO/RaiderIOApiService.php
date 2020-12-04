<?php


namespace App\Service\API\RaiderIO;


use App\Service\API\DefaultAPIService;
use Exception;
use RuntimeException;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class RaiderIOApiService extends DefaultAPIService
{
    public function __construct(SerializerInterface $serializer)
    {
        parent::__construct($serializer, "https://raider.io/api/v1/");
    }

    /**
     * @return array
     * @throws Exception
     * @throws TransportExceptionInterface
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     */
    public function getProfile() : array
    {
        $response = $this->getResponseInterface('GET', "characters/profile?region=eu&realm=Archimonde&name=Capuchon&fields=mythic_plus_highest_level_runs%2Cguild");

        if ($response->getStatusCode() === 200) {
            $data = json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR);
        } else
        {
            throw new RuntimeException("StatusError : " . $response->getStatusCode());
        }

        return $data;
    }
    /**
     * @return array
     * @throws Exception
     * @throws TransportExceptionInterface
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     */
    public function getAffixes() : array
    {
        $response = $this->getResponseInterface('GET', "mythic-plus/affixes?region=eu&locale=fr");

        if ($response->getStatusCode() === 200) {
            $data = json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR);
        } else
        {
            throw new RuntimeException("StatusError : " . $response->getStatusCode());
        }

        return $data;
    }
}