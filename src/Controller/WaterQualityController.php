<?php

namespace App\Controller;

use App\Utils\CallAPI\Entity\WaterQuality;
use App\Form\WaterQualityType;
use App\Utils\CallAPI\API_waterQualities;
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
     * @param API_waterQualities $API_waterQualities
     * @return Response
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function index(API_waterQualities $API_waterQualities): Response
    {
        return $this->render('water_quality/index.html.twig', [
            'water_qualities' => $API_waterQualities->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="water_quality_new", methods={"GET","POST"})
     * @param API_waterQualities $API_waterQualities
     * @param Request $request
     * @return Response
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function new(API_waterQualities $API_waterQualities, Request $request): Response
    {
        $waterQuality = new WaterQuality();
        $form = $this->createForm(WaterQualityType::class, $waterQuality);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $waterQuality->setCreatedAt(new \DateTime('now'));
            $API_waterQualities->post($waterQuality);
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
     * @param API_waterQualities $API_waterQualities
     * @return Response
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function show(int $id, API_waterQualities $API_waterQualities): Response
    {
        return $this->render('water_quality/show.html.twig', [
            'water_quality' => $API_waterQualities->find($id),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="water_quality_edit", methods={"GET","POST"})
     * @param int $id
     * @param Request $request
     * @param API_waterQualities $API_waterQualities
     * @return Response
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function edit(int $id, Request $request, API_waterQualities $API_waterQualities): Response
    {
        $waterQuality = $API_waterQualities->find($id);
        $form = $this->createForm(WaterQualityType::class, $waterQuality);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $API_waterQualities->put($waterQuality);
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
     * @param API_waterQualities $API_waterQualities
     * @return Response
     * @throws TransportExceptionInterface
     */
    public function delete(string $id, API_waterQualities $API_waterQualities): Response
    {
        $API_waterQualities->delete($id);
        return $this->redirectToRoute('water_quality_index');
    }
}
