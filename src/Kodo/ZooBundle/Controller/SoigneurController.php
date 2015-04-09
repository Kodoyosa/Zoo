<?php
namespace Kodo\ZooBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\UserBundle\Controller\SecurityController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

class SoigneurController extends Controller
{
    public function indexAction()
    {
        $securityContext = $this->container->get('security.context');

        if($securityContext->isGranted('ROLE_SUPER_ADMIN')){
            return $this->render('KodoZooBundle:Admin:index.html.twig', array(
                'users' => $users,
            ));
        }else {
            return $this->render('KodoZooBundle:Soigneur:index.html.twig');
            }
    }
}