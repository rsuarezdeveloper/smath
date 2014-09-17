<?php

namespace Smath\ClienteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Smath\ClienteBundle\Entity\TipoServicio;
use Smath\ClienteBundle\Form\TipoServicioType;

/**
 * TipoServicio controller.
 *
 * @Route("/tiposervicio")
 */
class TipoServicioController extends Controller
{

    /**
     * Lists all TipoServicio entities.
     *
     * @Route("/", name="tiposervicio")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SmathClienteBundle:TipoServicio')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new TipoServicio entity.
     *
     * @Route("/", name="tiposervicio_create")
     * @Method("POST")
     * @Template("SmathClienteBundle:TipoServicio:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new TipoServicio();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tiposervicio_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a TipoServicio entity.
     *
     * @param TipoServicio $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TipoServicio $entity)
    {
        $form = $this->createForm(new TipoServicioType(), $entity, array(
            'action' => $this->generateUrl('tiposervicio_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new TipoServicio entity.
     *
     * @Route("/new", name="tiposervicio_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new TipoServicio();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a TipoServicio entity.
     *
     * @Route("/{id}", name="tiposervicio_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SmathClienteBundle:TipoServicio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoServicio entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing TipoServicio entity.
     *
     * @Route("/{id}/edit", name="tiposervicio_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SmathClienteBundle:TipoServicio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoServicio entity.');
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
    * Creates a form to edit a TipoServicio entity.
    *
    * @param TipoServicio $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TipoServicio $entity)
    {
        $form = $this->createForm(new TipoServicioType(), $entity, array(
            'action' => $this->generateUrl('tiposervicio_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing TipoServicio entity.
     *
     * @Route("/{id}", name="tiposervicio_update")
     * @Method("PUT")
     * @Template("SmathClienteBundle:TipoServicio:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SmathClienteBundle:TipoServicio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoServicio entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('tiposervicio_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a TipoServicio entity.
     *
     * @Route("/{id}", name="tiposervicio_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SmathClienteBundle:TipoServicio')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TipoServicio entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tiposervicio'));
    }

    /**
     * Creates a form to delete a TipoServicio entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tiposervicio_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
