<?php
namespace Game\PlayerBundle\Service;

use FOS\UserBundle\Event\UserEvent;
use Game\PlayerBundle\Entity\AccessPlayer;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;


use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;


class LoginManager implements EventSubscriberInterface
{
    /** @var \Symfony\Component\Security\Core\SecurityContext */
    private $securityContext;

    /** @var \Doctrine\ORM\EntityManager */
    private $em;

    /**
     * Constructor
     *
     * @param SecurityContext $securityContext
     * @param Doctrine        $doctrine
     */
    public function __construct(SecurityContext $securityContext, Doctrine $doctrine)
    {
        $this->securityContext = $securityContext;
        $this->em = $doctrine->getEntityManager();
    }

    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::SECURITY_IMPLICIT_LOGIN => 'onImplicitLogin',
        );
    }


    private function saveLogin($user){
        $login = new AccessPlayer();

        $login->setPlayer($user);
        $this->em->persist($login);
        $this->em->flush();
    }

    public function onSecurityInteractivelogin(InteractiveLoginEvent $event)
    {

        $user = $event->getAuthenticationToken()->getUser();
        $request = $event->getRequest();

        if ($this->securityContext->isGranted('IS_AUTHENTICATED_FULLY')) {
            // user has just logged in
            $this->saveLogin( $user);
        }
    }

    public function onImplicitLogin()
    {
        echo "vaa";exit();
        $user = $event->getAuthenticationToken()->getUser();
        $request = $event->getRequest();

        if ($this->securityContext->isGranted('IS_AUTHENTICATED_FULLY')) {
            // user has just logged in
            $this->saveLogin( $user);
        }
    }

}