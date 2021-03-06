<?php

namespace Smath\EmpresaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Smath\EmpresaBundle\Entity\CompaniaCliente;
use Smath\EmpresaBundle\Form\CompaniaClienteType;

/**
 * CompaniaCliente controller.
 *
 * @Route("/companiacliente")
 */
class CompaniaClienteController extends Controller
{

    /**
     * Lists all CompaniaCliente entities.
     *
     * @Route("/", name="companiacliente")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SmathEmpresaBundle:CompaniaCliente')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Lists all Dos entities.
     *
     * @Route("/list", name="companiacliente_list")
     * @Method("GET")
     */
    public function listAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->getRepository('SmathEmpresaBundle:CompaniaCliente')->createQueryBuilder('cc')
        	   ->add('select','cc.id, cc.fechaIngreso, cc.estado, cl.razonSocial cliente, co.nombre compania, e.nombre empleado')
        	   ->leftJoin('cc.cliente','cl')
               ->leftJoin('cc.compania','co')
               ->leftJoin('cc.empleado','e')
        	   ->orderBy('co.nombre','ASC');
        $entities=$qb->getQuery()->getResult();
		$fields = array(
			'id' => 'cc.id',
			'fechaIngreso' => 'cc.fechaIngreso',
            'estado' => 'cc.estado',
            'cliente' => 'cl.razonSocial',
            'compania' => 'co.nombre',
            'empleado' => 'e.nombre'
		);
        
        $paginator = $this->get('knp_paginator');
        $r = $this->get('smath_helpers')->jqGridJson($request, $em, $qb, $fields, $paginator);
        
        $response = new Response();    
        return $response->setContent($r);
    }
    /**
     * Creates a new CompaniaCliente entity.
     *
     * @Route("/", name="companiacliente_create")
     * @Method("POST")
     * @Template("SmathEmpresaBundle:CompaniaCliente:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new CompaniaCliente();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('companiacliente_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a CompaniaCliente entity.
     *
     * @param CompaniaCliente $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(CompaniaCliente $entity)
    {
        $form = $this->createForm(new CompaniaClienteType(), $entity, array(
            'action' => $this->generateUrl('companiacliente_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new CompaniaCliente entity.
     *
     * @Route("/new", name="companiacliente_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new CompaniaCliente();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a CompaniaCliente entity.
     *
     * @Route("/{id}", name="companiacliente_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SmathEmpresaBundle:CompaniaCliente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CompaniaCliente entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing CompaniaCliente entity.
     *
     * @Route("/{id}/edit", name="companiacliente_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SmathEmpresaBundle:CompaniaCliente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CompaniaCliente entity.');
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
    * Creates a form to edit a CompaniaCliente entity.
    *
    * @param CompaniaCliente $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(CompaniaCliente $entity)
    {
        $form = $this->createForm(new CompaniaClienteType(), $entity, array(
            'action' => $this->generateUrl('companiacliente_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing CompaniaCliente entity.
     *
     * @Route("/{id}", name="companiacliente_update")
     * @Method("PUT")
     * @Template("SmathEmpresaBundle:CompaniaCliente:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SmathEmpresaBundle:CompaniaCliente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CompaniaCliente entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('companiacliente_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a CompaniaCliente entity.
     *
     * @Route("/{id}", name="companiacliente_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SmathEmpresaBundle:CompaniaCliente')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find CompaniaCliente entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('companiacliente'));
    }

    /**
     * Creates a form to delete a CompaniaCliente entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('companiacliente_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
