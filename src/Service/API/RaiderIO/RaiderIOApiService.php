<?php


namespace App\Service\API\RaiderIO;


use _HumbugBox9db2e91495d9\Nette\Neon\Exception;
use App\Service\API\DefaultAPIService;
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

        if ($response->getStatusCode() == 200) {
            $data = json_decode($response->getContent(), true);
        } else
        {
            throw new Exception("StatusError : " . $response->getStatusCode());
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

        if ($response->getStatusCode() == 200) {
            $data = json_decode($response->getContent(), true);
        } else
        {
            throw new Exception("StatusError : " . $response->getStatusCode());
        }

        return $data;
    }
}