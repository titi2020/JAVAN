<?php

namespace Game\PlayerBundle\Controller;


use Game\PlayerBundle\Entity\BuldingType;
use Game\PlayerBundle\Form\BuldingTypeType;
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
 * @Route("/buldingType")
 */
class BuldingTypeController extends Controller
{

    /**
     * Lists all Game entities.
     *
     * @Route("/", name="buldingType")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('GamePlayerBundle:BuldingType')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Game entity.
     *
     * @Route("/", name="buldingType_create")
     * @Method("POST")
     * @Template("GamePlayerBundle:BuldingType:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new BuldingType();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('buldingType_show', array('id' => $entity->getId())));
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
    private function createCreateForm(BuldingType $entity)
    {
        $form = $this->createForm(new BuldingTypeType(), $entity, array(
            'action' => $this->generateUrl('buldingType_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Game entity.
     *
     * @Route("/new", name="buldingType_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new BuldingType();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Game entity.
     *
     * @Route("/{id}", name="buldingType_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GamePlayerBundle:BuldingType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Bulding Type entity.');
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
     * @Route("/{id}/edit", name="buldingType_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GamePlayerBundle:BuldingType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Bulding Type entity.');
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
    private function createEditForm(BuldingType $entity)
    {
        $form = $this->createForm(new BuldingTypeType(), $entity, array(
            'action' => $this->generateUrl('buldingType_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Game entity.
     *
     * @Route("/{id}", name="buldingType_update")
     * @Method("PUT")
     * @Template("GamePlayerBundle:BuldingType:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GamePlayerBundle:BuldingType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Bulding Type entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('buldingType_edit', array('id' => $id)));
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
     * @Route("/{id}", name="buldingType_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GamePlayerBundle:BuldingType')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find  Bulding Type entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('buldingType'));
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
            ->setAction($this->generateUrl('buldingType_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }



}
