<?php

namespace App\Controller;

use App\Repository\FluxRSSRepository;
use FeedIo\FeedIo;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("/", name="dashboard")
     * @param FeedIo $feedIo
     * @param FluxRSSRepository $fluxRSSRepository
     * @return Response
     * @throws \Exception
     */
    public function index(FeedIo $feedIo, FluxRSSRepository $fluxRSSRepository)
    {
        $fluxRSSrep = $fluxRSSRepository->findByUserIsActive($this->getUser());

        $fluxRSS = [];

        foreach ($fluxRSSrep as $f) {
            $temp = [];
            $flux = $feedIo->read($f->getLink(), null, new \DateTime("- {$f->getHistory()}hours"))->getFeed();
            $feedIo->resetFilters();

            $temp['title'] = $f->getTitle();
            $temp['flux'] = $flux;

            $fluxRSS[] = $temp;
        }

        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
            'fluxRSS' => $fluxRSS
        ]);
    }
}
