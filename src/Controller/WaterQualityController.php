<?php

namespace App\Controller;

use App\Service\API\Aquarium\Entity\WaterQuality;
use App\Service\API\Aquarium\WaterQualitiesService;
use App\Form\WaterQualityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;


/**
 * @Route("/waterquality")
 */
class WaterQualityController extends AbstractController
{
    /**
     * @Route("/", name="water_quality_index", methods={"GET"})
     * @param WaterQualitiesService $waterQualitiesService
     * @return Response
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function index(WaterQualitiesService $waterQualitiesService): Response
    {
        return $this->render('water_quality/index.html.twig', [
            'water_qualities' => $waterQualitiesService->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="water_quality_new", methods={"GET","POST"})
     * @param WaterQualitiesService $waterQualitiesService
     * @param Request $request
     * @return Response
     * @throws TransportExceptionInterface
     */
    public function new(WaterQualitiesService $waterQualitiesService, Request $request): Response
    {
        $waterQuality = new WaterQuality();
        $form = $this->createForm(WaterQualityType::class, $waterQuality);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $waterQuality->setCreatedAt(new \DateTime('now'));
            $waterQualitiesService->post($waterQuality);
            return $this->redirectToRoute('water_quality_index');
        }

        return $this->render('water_quality/new.html.twig', [
            'water_quality' => $waterQuality,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="water_quality_show", methods={"GET"})
     * @param int $id
     * @param WaterQualitiesService $waterQualitiesService
     * @return Response
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function show(int $id, WaterQualitiesService $waterQualitiesService): Response
    {
        return $this->render('water_quality/show.html.twig', [
            'water_quality' => $waterQualitiesService->find($id),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="water_quality_edit", methods={"GET","POST"})
     * @param int $id
     * @param Request $request
     * @param WaterQualitiesService $waterQualitiesService
     * @return Response
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function edit(int $id, Request $request, WaterQualitiesService $waterQualitiesService): Response
    {
        $waterQuality = $waterQualitiesService->find($id);
        $form = $this->createForm(WaterQualityType::class, $waterQuality);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $waterQualitiesService->put($waterQuality);
            return $this->redirectToRoute('water_quality_index');
        }

        return $this->render('water_quality/edit.html.twig', [
            'water_quality' => $waterQuality,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="water_quality_delete", methods={"DELETE"})
     * @param string $id
     * @param WaterQualitiesService $waterQualitiesService
     * @return Response
     * @throws TransportExceptionInterface
     */
    public function delete(string $id, WaterQualitiesService $waterQualitiesService): Response
    {
        $waterQualitiesService->delete($id);
        return $this->redirectToRoute('water_quality_index');
    }
}
