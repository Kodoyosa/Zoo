<?php
namespace Kodo\ZooBundle\Controller;

use Kodo\ZooBundle\Entity\SOccuper;
use Kodo\ZooBundle\Form\AnimauxSoigneurType;
use FOS\UserBundle\Controller\SecurityController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SoccuperController extends Controller
{
    public function indexAction()
    {

        return $this->render('KodoZooBundle:SOccuper:index.html.twig');
    }

    public function affecterSoigneurAction(Request $request)
    {
        $soccuper = new SOccuper();
        $form = $this->get('form.factory')->create(new AnimauxSoigneurType(), $soccuper);

        if($form->handleRequest($request)->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($soccuper);
            $em->flush();

            return $this->redirect($this->generateUrl('prisca_zoo_soccuper_validation'));
        }

        return $this->render('KodoZooBundle:SOccuper:affecterSoigneur.html.twig', array(
            'form'  => $form->createView()
        ));
    }

    public function validationAction(){
        return $this->render('KodoZooBundle:SOccuper:validation.html.twig');
    }

}