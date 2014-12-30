<?php

namespace Game\PlayerBundle\Controller;

use Game\PlayerBundle\Entity\Player;
use Game\PlayerBundle\Entity\PlayerGame;
use Game\PlayerBundle\Form\PlayerGameType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Game\PlayerBundle\Entity\Game;
use Game\PlayerBundle\Form\GameType;

/**
 * Game controller.
 *
 * @Route("/playergame")
 */
class PlayerGameController extends Controller
{

    /**
     * Lists all Game entities.
     *
     * @Route("/", name="playergame")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('GamePlayerBundle:PlayerGame')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Game entity.
     *
     * @Route("/", name="playergame_create")
     * @Method("POST")
     * @Template("GamePlayerBundle:PlayerGame:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new PlayerGame();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('playergame_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Player entity.
     *
     * @param Game $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(PlayerGame $entity)
    {
        $form = $this->createForm(new PlayerGameType(), $entity, array(
            'action' => $this->generateUrl('playergame_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Game entity.
     *
     * @Route("/new", name="playergame_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new PlayerGame();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Game entity.
     *
     * @Route("/{id}", name="playergame_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GamePlayerBundle:PlayerGame')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Player Game entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Game entity.
     *
     * @Route("/{id}/edit", name="playergame_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GamePlayerBundle:PlayerGame')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Player game entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Game entity.
    *
    * @param Game $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(PlayerGame $entity)
    {
        $form = $this->createForm(new PlayerGameType(), $entity, array(
            'action' => $this->generateUrl('playergame_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Game entity.
     *
     * @Route("/{id}", name="playergame_update")
     * @Method("PUT")
     * @Template("GamePlayerBundle:PlayerGame:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GamePlayerBundle:PlayerGame')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Player Game entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('playergame_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Game entity.
     *
     * @Route("/{id}", name="playergame_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GamePlayerBundle:PlayerGame')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Player Game entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('playergame'));
    }

    /**
     * Creates a form to delete a Game entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('playergame_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }



}
