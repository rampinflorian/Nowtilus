<?php

namespace App\Controller;

use App\Entity\FluxRSS;
use App\Form\FluxRSSType;
use App\Repository\FluxRSSRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/flux/rss")
 */
class FluxRSSController extends AbstractController
{
    /**
     * @Route("/", name="fluxrss_index", methods={"GET"})
     * @param FluxRSSRepository $fluxRSSRepository
     * @return Response
     */
    public function index(FluxRSSRepository $fluxRSSRepository): Response
    {
        return $this->render('flux_rss/index.html.twig', [
            'fluxrsses' => $fluxRSSRepository->findByUser($this->getUser()),
        ]);
    }

    /**
     * @Route("/new", name="fluxrss_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $fluxRSS = new FluxRSS();
        $form = $this->createForm(FluxRSSType::class, $fluxRSS);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $fluxRSS->setUser($this->getUser());
            $entityManager->persist($fluxRSS);
            $entityManager->flush();

            return $this->redirectToRoute('fluxrss_index');
        }

        return $this->render('flux_rss/new.html.twig', [
            'fluxrss' => $fluxRSS,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="fluxrss_show", methods={"GET"})
     * @param FluxRSS $fluxRSS
     * @return Response
     */
    public function show(FluxRSS $fluxRSS): Response
    {
        return $this->render('flux_rss/show.html.twig', [
            'fluxrss' => $fluxRSS,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="fluxrss_edit", methods={"GET","POST"})
     * @param Request $request
     * @param FluxRSS $fluxRSS
     * @return Response
     */
    public function edit(Request $request, FluxRSS $fluxRSS): Response
    {
        $form = $this->createForm(FluxRSSType::class, $fluxRSS);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('fluxrss_index');
        }

        return $this->render('flux_rss/edit.html.twig', [
            'fluxrss' => $fluxRSS,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="fluxrss_delete", methods={"DELETE"})
     * @param Request $request
     * @param FluxRSS $fluxRSS
     * @return Response
     */
    public function delete(Request $request, FluxRSS $fluxRSS): Response
    {
        if ($this->isCsrfTokenValid('delete' . $fluxRSS->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($fluxRSS);
            $entityManager->flush();
        }

        return $this->redirectToRoute('fluxrss_index');
    }
}
