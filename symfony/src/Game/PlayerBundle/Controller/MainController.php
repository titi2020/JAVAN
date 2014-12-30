<?php

namespace Game\PlayerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;

class MainController extends Controller
{
    /**
     * @Route("/", name="home")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager()->getRepository('GamePlayerBundle:Game');
        $games = $em->findAll();
        return $this->render('GamePlayerBundle:Main:index.html.twig', array("games" => $games, "num" => count($games)));
    }

    /**
     * @Route("/how", name="how")
     * @Template()
     */
    public function howAction()
    {
        $form = $this->container->get('fos_user.registration.form');
        $formHandler = $this->container->get('fos_user.registration.form.handler');
        $confirmationEnabled = $this->container->getParameter('fos_user.registration.confirmation.enabled');
        $process = $formHandler->process($confirmationEnabled);
        if ($process) {
            $user = $form->getData();

            if ($confirmationEnabled) {
                $this->container->get('session')->set('fos_user_send_confirmation_email/email', $user->getEmail());
            }

            $this->get('session')->getFlashBag()->set('success', 'Funciono. A disfrutar!');


            $em = $this->getDoctrine()->getManager()->getRepository('GamePlayerBundle:Game');
            $games = $em->findAll();
            return $this->render('GamePlayerBundle:Main:index.html.twig', array("games" => $games, "num" => count($games)));
        }

        return $this->container->get('templating')->renderResponse('GamePlayerBundle:Main:how.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/create", name="create")
     * @Template()
     */
    public function createAction()
    {
        $form = $this->container->get('fos_user.registration.form');
        $formHandler = $this->container->get('fos_user.registration.form.handler');
        $confirmationEnabled = $this->container->getParameter('fos_user.registration.confirmation.enabled');
        $process = $formHandler->process($confirmationEnabled);
        if ($process) {
            $user = $form->getData();

            if ($confirmationEnabled) {
                $this->container->get('session')->set('fos_user_send_confirmation_email/email', $user->getEmail());
            }

            $this->get('session')->getFlashBag()->set('success', 'Funciono. A disfrutar!');


            $em = $this->getDoctrine()->getManager()->getRepository('GamePlayerBundle:Game');
            $games = $em->findAll();
            return $this->render('GamePlayerBundle:Main:index.html.twig', array("games" => $games, "num" => count($games)));
        }

        return $this->container->get('templating')->renderResponse('GamePlayerBundle:Main:create.html.twig', array(
            'form' => $form->createView(),
        ));
    }



}
