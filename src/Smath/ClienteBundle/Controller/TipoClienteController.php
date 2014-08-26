<?php

namespace Smath\ClienteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Smath\ClienteBundle\Entity\TipoCliente;
use Smath\ClienteBundle\Form\TipoClienteType;

/**
 * TipoCliente controller.
 *
 * @Route("/tipocliente")
 */
class TipoClienteController extends Controller
{

    /**
     * Lists all TipoCliente entities.
     *
     * @Route("/", name="tipocliente")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SmathClienteBundle:TipoCliente')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new TipoCliente entity.
     *
     * @Route("/", name="tipocliente_create")
     * @Method("POST")
     * @Template("SmathClienteBundle:TipoCliente:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new TipoCliente();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tipocliente_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a TipoCliente entity.
     *
     * @param TipoCliente $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TipoCliente $entity)
    {
        $form = $this->createForm(new TipoClienteType(), $entity, array(
            'action' => $this->generateUrl('tipocliente_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new TipoCliente entity.
     *
     * @Route("/new", name="tipocliente_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new TipoCliente();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a TipoCliente entity.
     *
     * @Route("/{id}", name="tipocliente_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SmathClienteBundle:TipoCliente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoCliente entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing TipoCliente entity.
     *
     * @Route("/{id}/edit", name="tipocliente_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SmathClienteBundle:TipoCliente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoCliente entity.');
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
    * Creates a form to edit a TipoCliente entity.
    *
    * @param TipoCliente $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TipoCliente $entity)
    {
        $form = $this->createForm(new TipoClienteType(), $entity, array(
            'action' => $this->generateUrl('tipocliente_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing TipoCliente entity.
     *
     * @Route("/{id}", name="tipocliente_update")
     * @Method("PUT")
     * @Template("SmathClienteBundle:TipoCliente:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SmathClienteBundle:TipoCliente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoCliente entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('tipocliente_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a TipoCliente entity.
     *
     * @Route("/{id}", name="tipocliente_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SmathClienteBundle:TipoCliente')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TipoCliente entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tipocliente'));
    }

    /**
     * Creates a form to delete a TipoCliente entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tipocliente_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
