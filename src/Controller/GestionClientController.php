<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\RdvPlanning;
use App\Entity\Client;
use App\Service\Trajet;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class GestionClientController extends AbstractController
{
    /**
     * @Route("/marina/client", name="gestion_client")
     */
    public function index(Request $request)
    {
        $Trajet = new Trajet();
        
        $entityPeriode = ['message' => 'Type your message here'];

        $formPeriode = $this->createFormBuilder($entityPeriode)
            ->add('period', DateTimeType::class, [
                'label' => 'Période',
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'js-datepicker',
                    'autocomplete' => 'off'
                ],
                'html5' => false,
                'format' => 'dd/MM/yyyy',
            ])
        ->add('save', SubmitType::class, ['label' => 'filtrer'])
        ->getForm();
        $formPeriode->handleRequest($request);
        $periode =""; 
        if ($formPeriode->isSubmitted() && $formPeriode->isValid()) {

            $periode = $formPeriode->getData()['period']->format('Ym');
            
            
            $planning = $this->getDoctrine()
                ->getRepository(RdvPlanning::class)
                ->findByPeriode($periode);
        } else {
            $planning = $this->getDoctrine()
                ->getRepository(RdvPlanning::class)
                ->findAll();
        }

        $stats = $Trajet->calculTotalKM($planning);
        $stats["tempsTravaille"] = $Trajet->calculTempsTravaille($planning);
        $stats["periode"] = $periode;

        return $this->render('gestion_client/index.html.twig', [
            'controller_name' => 'GestionClientController',
            'planning' => $planning,
            'stats' => $stats,
            'formFilter' => $formPeriode->createView(),
        ]);
    }

    /**
     * @Route("/marina/client/creationClient", name="gestion_client_creationClient")
     */

     public function creationClient(Request $request){

        $Client = new Client();

        $form = $this->createFormBuilder($Client)
            ->add('nom', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Enregistrer'])
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() ) {
            $Client->setStatus(true);

            $em = $this->getDoctrine()->getManager();
            $em->persist($Client);
            $em->flush();


            return $this->redirectToRoute('gestion_client');

        }
        $errors = $form->getErrors();

        return $this->render('gestion_client/creationClient.html.twig', [
            'controller_name' => 'GestionClientController',
            'form' => $form->createView(),
            'errors' => $errors,
        ]);
     }


    /**
     * @Route("/marina/client/creationRDV", name="gestion_client_creationRDV")
     */
    public function creationRDV(Request $request){

        $RdvPlanning = new RdvPlanning();

        $form = $this->createFormBuilder($RdvPlanning)
            ->add('Client', EntityType::class, [
                'class' => Client::class,
                'choice_label' => 'nom',
                'label' => 'Nom du client',
            ])
            ->add('heureDebut', DateTimeType::class, [
                'label' => 'Heure début',
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'js-datepicker',
                    'autocomplete' => 'off'
                ],
                'html5' => false,
                'format' => 'dd/MM/yyyy HH:mm',
            ])
            ->add('heureFin', DateTimeType::class, [
                'label' => 'Heure Fin',
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'js-datepicker',
                    'autocomplete' => 'off'
                ],
                'html5' => false,
                'format' => 'dd/MM/yyyy HH:mm',
            ])
            ->add('kmLibre', TextType::class)
            ->add('kmPaye', TextType::class)
            ->add('commentaire', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Enregistrer'])
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $RdvPlanning->setAnnule(false);
            $RdvPlanning->setHorodatage(new \DateTime('now'));
            $RdvPlanning->setPeriode($RdvPlanning->getHeureDebut()->format('Ym'));

            $em = $this->getDoctrine()->getManager();
            $em->persist($RdvPlanning);
            $em->flush();
            return $this->redirectToRoute('gestion_client');
        }
        return $this->render('gestion_client/creationRDV.html.twig', [
            'controller_name' => 'GestionClientController',
            'form' => $form->createView(),
        ]);
    }
}
