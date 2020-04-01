<?php

namespace App\Controller;

use FeedIo\FeedIo;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("/", name="dashboard")
     * @param FeedIo $feedIo
     * @return Response
     * @throws \Exception
     */
    public function index(FeedIo $feedIo)
    {

        $result = $feedIo->read('https://www.bfmtv.com/rss/info/flux-rss/flux-toutes-les-actualites/', null, new \DateTime('- 1 days'))->getFeed();
        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
            'result' => $result
        ]);
    }
}
