<?php
namespace Kodo\ZooBundle\Controller;

use Kodo\ZooBundle\Entity\Especes;
use Kodo\ZooBundle\Form\EspecesType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EspeceController extends Controller
{
    public function indexAction()
    {

        $especes = $this->GetDoctrine()
            ->getRepository('KodoZooBundle:Especes')
            ->findAll();;

        return $this->container->get('templating')->renderResponse('KodoZooBundle:Especes:especes.html.twig', array(
            'especes' => $especes,
        ));
    }

    public function ajouterAction(Request $request){

        $espece = new Especes();
        $form = $this->get('form.factory')->create(new EspecesType(), $espece);

        if($form->handleRequest($request)->isValid()) {


            $em = $this->getDoctrine()->getManager();
            $em->persist($espece);
            $em->flush();


            return $this->redirect($this->generateUrl('kodo_zoo_espece_validation_action'));
        }

        return $this->render('KodoZooBundle:Especes:ajouter.html.twig', array(
            'form'  => $form->createView()
        ));

    }

    public function supprimerAction($id, Request $request){

        $em = $this->getDoctrine()->getManager();

        $espece = $em->getRepository('KodoZooBundle:Especes')->find($id);

        if (null === $espece) {
            throw new NotFoundHttpException("L'espece".$id." n'existe pas.");
        }

        $form = $this->createFormBuilder()->getForm();

        if ($form->handleRequest($request)->isValid()) {

            $em->remove($espece);
            $em->flush();

            return $this->redirect($this->generateUrl('kodo_zoo_espece_validation_action'));
        }

        return $this->render('KodoZooBundle:Especes:supprimer.html.twig', array(
            'espece' => $espece,
            'form'   => $form->createView()
        ));

    }

    public function validationAction(){
        return $this->render('KodoZooBundle:Especes:validation.html.twig');
    }
}