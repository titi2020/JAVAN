<?php

namespace Game\PlayerBundle\Controller;


use Game\PlayerBundle\Entity\AccessPlayer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Model\UserInterface;

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
        $em = $this->getDoctrine()->getManager()->getRepository('GamePlayerBundle:Player');
        $user = $em->findAll();
        return $this->render('GamePlayerBundle:Main:index.html.twig', array(
            "games" => $games,
            "num" => count($games),
            "numUse" => count($user)));
    }

    /**
     * @Route("/how", name="how")
     * @Template()
     */
    public function howAction(Request $request)
    {
        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->get('fos_user.registration.form.factory');
        /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
        $userManager = $this->get('fos_user.user_manager');
        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $user = $userManager->createUser();
        $user->setEnabled(true);

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $form = $formFactory->createForm();
        $form->setData($user);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);

            $userManager->updateUser($user);

            if (null === $response = $event->getResponse()) {
                $url = $this->generateUrl('fos_user_registration_confirmed');
                $response = new RedirectResponse($url);
            }

            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

            $this->get('session')->getFlashBag()->set('success', 'Funciono. A disfrutar!');

            $em = $this->getDoctrine()->getManager()->getRepository('GamePlayerBundle:Game');
            $games = $em->findAll();
            $em = $this->getDoctrine()->getManager()->getRepository('GamePlayerBundle:Player');
            $user = $em->findAll();
            return $this->render('GamePlayerBundle:Main:index.html.twig', array(
                "games" => $games,
                "num" => count($games),
                "numUse" => count($user)));
        }

        return $this->render('FOSUserBundle:Main:how.html.twig', array(
            'form' => $form->createView(),
        ));

    }

    /**
     * @Route("/create", name="create")
     * @Template()
     */
    public function createAction(Request $request)
    {
        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->get('fos_user.registration.form.factory');
        /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
        $userManager = $this->get('fos_user.user_manager');
        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $user = $userManager->createUser();
        $user->setEnabled(true);

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $form = $formFactory->createForm();
        $form->setData($user);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);

            $userManager->updateUser($user);

            if (null === $response = $event->getResponse()) {
                $url = $this->generateUrl('fos_user_registration_confirmed');
                $response = new RedirectResponse($url);
            }

            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

            $this->get('session')->getFlashBag()->set('success', 'Funciono. A disfrutar!');

            $em = $this->getDoctrine()->getManager()->getRepository('GamePlayerBundle:Game');
            $games = $em->findAll();
            $em = $this->getDoctrine()->getManager()->getRepository('GamePlayerBundle:Player');
            $user = $em->findAll();
            return $this->render('GamePlayerBundle:Main:index.html.twig', array(
                "games" => $games,
                "num" => count($games),
                "numUse" => count($user)));
        }

        return $this->render('FOSUserBundle:Main:create.html.twig', array(
            'form' => $form->createView(),
        ));
    }

}
