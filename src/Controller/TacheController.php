<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use  Doctrine\Common\Persistence\ManagerRegistry;
use App\Entity\Taches;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;




class TacheController extends AbstractController
{
    
    /**
     * @Route("/tache", name="tache")
     */
    public function index()
    {
        $repo = $this->getDoctrine()->getRepository(Taches::class);
        $taches = $repo->findAll();
        
        return $this->render('tache/index.html.twig', [
            'controller_name' => 'TacheController',
            'taches'=> $taches
            ]);
    }
/**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('tache/home.html.twig', [
        ]);
    }
    

/**
     * @Route("/tache/new", name="tache_create")
     * @Route("/tache/{id}/edit", name="tache_edit")

     */
    public function form(Taches $taches = null,Request $request, ManagerRegistry $managerRegistry)
    {
      if(!$taches){  
       $taches = new Taches();
      }
       

       $form = $this->createFormBuilder($taches)
                    ->add('titre',TextType::class,[
                        'attr' => [
                            'placeholder' => "Titre de la tâche",

                            ]
                    ] )
                    ->add('description',TextareaType::class,[
                        'attr' => [
                            'placeholder' => "Description de la tâche",

                        ]
                    ])
                    ->add('statut',ChoiceType::class,[
                        'choices' => [
                            'Fait' => "fait",
                            'A faire' => "a faire",

                            'En cours' => "en cours",


                        ]
                    ])
                 
                    ->getForm();


        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            if(!$taches ->getId()){
                $taches ->setDateCreation(new \DateTime() );


            }

            $em = $managerRegistry->getManager();

            $em->persist($taches);
            $em->flush();

            return $this ->redirectToRoute('tache_show',['id' => $taches->getID()]);
        }


        return $this->render('tache/create.html.twig', [
           'formTache' => $form->createView(),
           'editMode'=> $taches->getId() !==null
        ]
        );
    }
  /**
     * @Route("/delete/{id}", name="tache_delete")
     */
    public function delete($id,Taches $tache, ManagerRegistry $managerRegistry)
{
   
    $em = $managerRegistry->getManager();

    $em->remove($tache);
    $em->flush();    

    return $this ->redirectToRoute('tache');
    }


    /**
     * @Route("/tache/{id}", name="tache_show")
     */
    public function show($id)
    {
        $repo= $this ->getDoctrine() ->getRepository(Taches::class);
        $taches = $repo -> find($id);
        return $this->render('tache/show.html.twig', [
            'controller_name' => 'TacheController',
            'taches' => $taches
        ]
        );
    }


    

}
