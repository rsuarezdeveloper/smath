<?php

namespace Smath\EmpresaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Smath\EmpresaBundle\Entity\Empleado;
use Smath\EmpresaBundle\Form\EmpleadoType;

/**
 * Empleado controller.
 *
 * @Route("/empleado")
 */
class EmpleadoController extends Controller
{

    /**
     * Lists all Empleado entities.
     *
     * @Route("/", name="empleado")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SmathEmpresaBundle:Empleado')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Lists all Dos entities.
     *
     * @Route("/list", name="empleado_list")
     * @Method("GET")
     */
    public function listAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->getRepository('SmathEmpresaBundle:Empleado')->createQueryBuilder('e')
        	   ->add('select','e.id, e.codigo, e.nombre, e.telefono, e.estado, d.nombre departamento, te.nombre tipoEmpleado, gu.nombre geoUbicacion')
        	   ->leftJoin('e.departamento','d')
               ->leftJoin('e.tipoEmpleado','te')
               ->leftJoin('e.geoUbicacion','gu')
        	   ->orderBy('e.nombre','ASC');
        $entities = $qb->getQuery()->getResult();
		$fields = array(
			'id' => 'e.id',
			'codigo' => 'e.codigo',
            'nombre' => 'e.nombre',
            'telefono' => 'e.telefono',
            'estado' => 'e.estado',
            'departamento' => 'd.nombre',
            'tipoEmpleado' => 'te.nombre',
            'geoUbicacion' => 'gu.nombre'
		);

        $paginator = $this->get('knp_paginator');
        $r = $this->get('smath_helpers')->jqGridJson($request, $em, $qb, $fields, $paginator);
        
        $response = new Response();    
        return $response->setContent($r);
    }
    
    /**
     * Creates a new Empleado entity.
     *
     * @Route("/", name="empleado_create")
     * @Method("POST")
     * @Template("SmathEmpresaBundle:Empleado:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Empleado();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('empleado'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Empleado entity.
     *
     * @param Empleado $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Empleado $entity)
    {
        $form = $this->createForm(new EmpleadoType(), $entity, array(
            'action' => $this->generateUrl('empleado_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Empleado entity.
     *
     * @Route("/new", name="empleado_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Empleado();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Empleado entity.
     *
     * @Route("/{id}", name="empleado_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SmathEmpresaBundle:Empleado')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Empleado entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Empleado entity.
     *
     * @Route("/{id}/edit", name="empleado_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SmathEmpresaBundle:Empleado')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Empleado entity.');
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
    * Creates a form to edit a Empleado entity.
    *
    * @param Empleado $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Empleado $entity)
    {
        $form = $this->createForm(new EmpleadoType(), $entity, array(
            'action' => $this->generateUrl('empleado_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Empleado entity.
     *
     * @Route("/{id}", name="empleado_update")
     * @Method("PUT")
     * @Template("SmathEmpresaBundle:Empleado:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SmathEmpresaBundle:Empleado')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Empleado entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('empleado'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Empleado entity.
     *
     * @Route("/{id}", name="empleado_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SmathEmpresaBundle:Empleado')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Empleado entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('empleado'));
    }

    /**
     * Creates a form to delete a Empleado entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('empleado_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
