<?php
namespace Kodo\ZooBundle\Controller;

use FOS\UserBundle\Form\Type\ProfileFormType;
use Kodo\ZooBundle\Entity\Soigneurs;
use Kodo\ZooBundle\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use FOS\UserBundle\Model\UserManagerInterface;
use \DateTime;

class AdminController extends Controller
{
    public function indexAction()
    {
        return $this->render('KodoZooBundle:Admin:index.html.twig');
    }

    public function gestionAction()
    {
        $userManager= $this->get('fos_user.user_manager');
        $users= $userManager->findUsers();

        return $this->render('KodoZooBundle:Admin:gestion.html.twig', array(
            'users' => $users
        ));
    }

    public function promoteAction($id, Request $request){

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('KodoZooBundle:User')->find($id);

        if (null === $user){
            throw new NotFoundHttpException( 'L\'utilisateur '.$id.' n\'a pas été trouvé.');
        }
        $form = $this->createFormBuilder()->getForm();

        if ($form->handleRequest($request)->isValid()) {
            $role = array('ROLE_ADMIN');
            $user->setRoles($role);
            $this->get('fos_user.user_manager')->updateUser($user, false);

            $soigneur = new Soigneurs();
            $soigneur->setPseudo($user->getUsername());
            $soigneur->setDateembauche(new DateTime("now"));

            $em = $this->getDoctrine()->getManager();
            $em->persist($soigneur);
            $em->flush();

            $this->getDoctrine()->getManager()->flush();
            return $this->render('KodoZooBundle:Admin:validation.html.twig');
        }

        return $this->render('KodoZooBundle:Admin:promotion.html.twig', array(
            'user'  =>  $user,
            'form'  =>  $form->createView()
        ));
    }

    public function downgradeAction($id, Request $request){

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('KodoZooBundle:User')->find($id);

        if (null === $user){
            throw new NotFoundHttpException( 'L\'utilisateur '.$id.' n\'a pas été trouvé.');
        }
        $form = $this->createFormBuilder()->getForm();

        if ($form->handleRequest($request)->isValid()) {
            $role = array('ROLE_USER');
            $user->setRoles($role);
            $this->get('fos_user.user_manager')->updateUser($user, false);

            $username = $user->getUsername();

            $soigneur = $em->getRepository('KodoZooBundle:Soigneurs')->findOneBy(array('pseudo'   =>  $username));

            $em->remove($soigneur);
            $em->flush();

            $this->getDoctrine()->getManager()->flush();
            return $this->render('KodoZooBundle:Admin:validation.html.twig');
        }

        return $this->render('KodoZooBundle:Admin:downgrade.html.twig', array(
            'user'  =>  $user,
            'form'  =>  $form->createView()
        ));
    }

    public function validationAction()
    {
        return $this->render('KodoZooBundle:Admin:validation.html.twig');
    }

    public function supprimerAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('KodoZooBundle:User')->find($id);

        if (null === $user){
            throw new NotFoundHttpException( 'L\'utilisateur '.$id.' n\'a pas été trouvé.');
        }
        $form = $this->createFormBuilder()->getForm();

        if ($form->handleRequest($request)->isValid()) {

            $username = $user->getUsername();

            $soigneur = $em->getRepository('KodoZooBundle:Soigneurs')->findOneBy(array('pseudo'   =>  $username));

            $em->remove($soigneur);
            $em->flush();

            $this->get('fos_user.user_manager')->deleteUser($user);

            $this->getDoctrine()->getManager()->flush();
            return $this->render('KodoZooBundle:Admin:validation.html.twig');
        }

        return $this->render('KodoZooBundle:Admin:supprimer.html.twig', array(
            'user'  =>  $user,
            'form'  =>  $form->createView()
        ));
    }
}