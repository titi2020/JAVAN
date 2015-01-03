<?php

namespace Game\PlayerBundle\Controller;

use Game\PlayerBundle\Entity\AccessPlayer;
use Game\PlayerBundle\Form\AccessPlayerType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Game\PlayerBundle\Entity\Game;
use Game\PlayerBundle\Form\GameType;

/**
 * AccessPlayer controller.
 *
 * @Route("/accessPlayer")
 */
class AccessPlayerController extends Controller
{

    /**
     * Lists all Game entities.
     *
     * @Route("/", name="accessPlayer")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('GamePlayerBundle:AccessPlayer')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Game entity.
     *
     * @Route("/", name="accessPlayer_create")
     * @Method("POST")
     * @Template("GamePlayerBundle:AccessPlayer:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new AccessPlayer();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('building_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Game entity.
     *
     * @param Game $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(AccessPlayer $entity)
    {
        $form = $this->createForm(new AccessPlayerType(), $entity, array(
            'action' => $this->generateUrl('accessPlayer_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Game entity.
     *
     * @Route("/new", name="accessPlayer_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new AccessPlayer();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Game entity.
     *
     * @Route("/{id}", name="accessPlayer_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GamePlayerBundle:AccessPlayer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AccessPlayer entity.');
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
     * @Route("/{id}/edit", name="accessPlayer_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GamePlayerBundle:AccessPlayer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AccessPlayer entity.');
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
    * Creates a form to edit a AccessPlayer entity.
    *
    * @param $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(AccessPlayer $entity)
    {
        $form = $this->createForm(new AccessPlayerType(), $entity, array(
            'action' => $this->generateUrl('accessPlayer_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing AccessPlayer entity.
     *
     * @Route("/{id}", name="accessPlayer_update")
     * @Method("PUT")
     * @Template("GamePlayerBundle:AccessPlayer:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GamePlayerBundle:AccessPlayer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AccessPlayer entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('accessPlayer_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a AccessPlayer entity.
     *
     * @Route("/{id}", name="accessPlayer_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GamePlayerBundle:AccessPlayer')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find AccessPlayer entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('accessPlayer'));
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
            ->setAction($this->generateUrl('accessPlayer_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }



}
