<?php

namespace App\Controller;

use App\Entity\WaterQuality;
use App\Form\WaterQualityType;
use App\Repository\WaterQualityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/waterquality")
 */
class WaterQualityController extends AbstractController
{
    /**
     * @Route("/", name="water_quality_index", methods={"GET"})
     * @param WaterQualityRepository $waterQualityRepository
     * @return Response
     */
    public function index(WaterQualityRepository $waterQualityRepository): Response
    {
        return $this->render('water_quality/index.html.twig', [
            'water_qualities' => $waterQualityRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="water_quality_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $waterQuality = new WaterQuality();
        $form = $this->createForm(WaterQualityType::class, $waterQuality);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($waterQuality);
            $entityManager->flush();

            return $this->redirectToRoute('water_quality_index');
        }

        return $this->render('water_quality/new.html.twig', [
            'water_quality' => $waterQuality,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="water_quality_show", methods={"GET"})
     * @param WaterQuality $waterQuality
     * @return Response
     */
    public function show(WaterQuality $waterQuality): Response
    {
        return $this->render('water_quality/show.html.twig', [
            'water_quality' => $waterQuality,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="water_quality_edit", methods={"GET","POST"})
     * @param Request $request
     * @param WaterQuality $waterQuality
     * @return Response
     */
    public function edit(Request $request, WaterQuality $waterQuality): Response
    {
        $form = $this->createForm(WaterQualityType::class, $waterQuality);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('water_quality_index');
        }

        return $this->render('water_quality/edit.html.twig', [
            'water_quality' => $waterQuality,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="water_quality_delete", methods={"DELETE"})
     * @param Request $request
     * @param WaterQuality $waterQuality
     * @return Response
     */
    public function delete(Request $request, WaterQuality $waterQuality): Response
    {
        if ($this->isCsrfTokenValid('delete' . $waterQuality->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($waterQuality);
            $entityManager->flush();
        }

        return $this->redirectToRoute('water_quality_index');
    }
}
