<?php

namespace App\Controller;

use App\Service\API\RaiderIO\RaiderIOApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class RaidWowController
 * @package App\Controller
 * @Route("/raidwow")
 */
class RaidWowController extends AbstractController
{
    /**
     * @Route("/", name="raidwow_index")
     * @param RaiderIOApiService $raiderIOApiService
     * @return Response
     */
    public function index(RaiderIOApiService $raiderIOApiService): Response
    {


        return $this->render('raid_wow/index.html.twig', [
            'raiderio_profile' => $raiderIOApiService->getProfile(),
            'raiderio_affixes' => $raiderIOApiService->getAffixes()
        ]);
    }
}
