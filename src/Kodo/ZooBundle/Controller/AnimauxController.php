<?php
namespace Kodo\ZooBundle\Controller;

use Kodo\ZooBundle\Entity\Animaux;
use Kodo\ZooBundle\Entity\TypeAlimentation;
use Kodo\ZooBundle\Form\AnimauxModifierType;
use Kodo\ZooBundle\Form\AnimauxType;
use Kodo\ZooBundle\Form\AnimauxSoigneurType;
use Kodo\ZooBundle\Form\RechercheType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AnimauxController extends Controller
{
    public function indexAction()
    {
        $animaux = $this->getDoctrine()
                        ->getManager()
                        ->getRepository('KodoZooBundle:Animaux')
                        ->findAll();

        $especes = $this->GetDoctrine()
                        ->getRepository('KodoZooBundle:Especes')
                        ->findAll();

        $alimentations = $this->GetDoctrine()
            ->getRepository('KodoZooBundle:TypeAlimentation')
            ->findAll();


        return $this->container->get('templating')->renderResponse('KodoZooBundle:Animaux:animaux.html.twig', array(
            'animaux'   => $animaux,
            'especes'    => $especes,
            'alimentations' => $alimentations,
        ));
    }

    public function gestionAction()
    {
        $animaux = $this->getDoctrine()
            ->getManager()
            ->getRepository('KodoZooBundle:Animaux')
            ->findAll();

        $especes = $this->GetDoctrine()
            ->getRepository('KodoZooBundle:Especes')
            ->findAll();

        return $this->render('KodoZooBundle:Animaux:gestion.html.twig', array(
            'animaux'   => $animaux,
            'especes'   => $especes
        ));
    }

    public function ajouterAction(Request $request)
    {
        $animal = new Animaux();
        $form = $this->get('form.factory')->create(new AnimauxType(), $animal);

        if($form->handleRequest($request)->isValid()) {


            $em = $this->getDoctrine()->getManager();
            $em->persist($animal);
            $em->flush();

            return $this->redirect($this->generateUrl('kodo_zoo_animaux_validation_action'));
        }

        return $this->render('KodoZooBundle:Animaux:ajouter.html.twig', array(
        'form'  => $form->createView()
    ));
    }

    public function modifierAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $animal = $em->getRepository('KodoZooBundle:Animaux')->find($id);

        if (null === $animal){
            throw new NotFoundHttpException('L\'animal '.$id.'n\'a pas été trouvé');
        }

        $form = $this->createForm(new AnimauxModifierType(), $animal);

        if($form->handleRequest($request)->isValid()){
            $em->flush();

            return $this->redirect($this->generateUrl('kodo_zoo_animaux_validation_action', array(
                'id'    =>  $animal->getId()
            )));
        }

        return $this->render('KodoZooBundle:Animaux:modifier.html.twig', array(
            'form' => $form->createView(),
            'animal' => $animal
        ));
    }

    public function supprimerAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $animal = $em->getRepository('KodoZooBundle:Animaux')->find($id);

        if (null === $animal) {
            throw new NotFoundHttpException("L'animal".$id." n'existe pas.");
        }

        $form = $this->createFormBuilder()->getForm();

        if ($form->handleRequest($request)->isValid()) {
            $em->remove($animal);
            $em->flush();

            return $this->redirect($this->generateUrl('kodo_zoo_animaux_validation_action'));
        }

        return $this->render('KodoZooBundle:Animaux:supprimer.html.twig', array(
            'animal' => $animal,
            'form'   => $form->createView()
        ));
    }

    public function validationAction(){
        return $this->render('KodoZooBundle:Animaux:validation.html.twig');
    }

    public function rechercheAction(){
        $form = $this->createForm(new RechercheType());
        return $this->render('KodoZooBundle:Animaux:recherche.html.twig', array('form' => $form->createView()));
    }

    public function rechercheTraitementAction(){

        $form = $this->createForm(new RechercheType());
        if($this->get('request')->getMethod() == 'POST')
        {
            $form->bind($this->get('request'));
            $em = $this->getDoctrine()->getManager();
            $animal = $em->getRepository('KodoZooBundle:Animaux')->recherche($form['recherche']->getData());
        }
        return $this->render('KodoZooBundle:Animaux:animaux.html.twig', array('animaux' => $animal));
    }

    public function ListAction($page)
    {
        $maxAnimaux = $this->container->getParameter('max_animaux_per_page');
        $animaux_count = $this->getDoctrine()
            ->getRepository('KodoZooBundle:Animaux')
            ->countPublishedTotal();
        $pagination = array(
            'page' => $page,
            'route' => 'animaux_list',
            'pages_count' => ceil($animaux_count / $maxAnimaux),
            'route_params' => array()
        );

        $animaux = $this->getDoctrine()->getRepository('KodoZooBundle:Animaux')
            ->getList($page, $maxAnimaux);

        return $this->render('KodoZooBundle:Animaux:animaux.html.twig', array(
            'animal' => $animaux,
            'pagination' => $pagination
        ));
    }

}