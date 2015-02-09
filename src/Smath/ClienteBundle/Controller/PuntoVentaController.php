<?php

namespace Smath\ClienteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Smath\ClienteBundle\Entity\PuntoVenta;
use Smath\ClienteBundle\Form\PuntoVentaType;

/**
 * PuntoVenta controller.
 *
 * @Route("/puntoventa")
 */
class PuntoVentaController extends Controller
{

    /**
     * Lists all PuntoVenta entities.
     *
     * @Route("/", name="puntoventa")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SmathClienteBundle:PuntoVenta')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Lists all PuntoVenta entities.
     *
     * @Route("/list", name="puntoventa_list")
     * @Method("GET")
     */
    public function listAction(Request $request)
    {
        
        $em = $this->getDoctrine()->getManager();
        $qb = $em->getRepository('SmathClienteBundle:PuntoVenta')->createQueryBuilder('pv')
        	   ->add('select', 'pv.id, c.razonSocial cliente, pv.nombre, pv.numeroDocumento, pv.direccion, pv.telefono1, pv.correoElectronico, pv.estado')
        	   ->leftJoin('pv.cliente', 'c');

		$fields = array(
			'id' => 'pv.id',
			'cliente' => 'c.razonSocial',
            'nombre' => 'pv.nombre',
            'numeroDocumento' => 'pv.numeroDocumento',
            'direccion' => 'pv.direccion',
            'telefono1' => 'pv.telefono1',
            'correoElectronico' => 'pv.correoElectronico',
            'estado' => 'pv.estado',
		);
        
        $paginator = $this->get('knp_paginator');
        $r = $this->get('smath_helpers')->jqGridJson($request, $em, $qb, $fields, $paginator);
        
        $response = new Response();    
        return $response->setContent($r);
    }
    /**
     * Creates a new PuntoVenta entity.
     *
     * @Route("/", name="puntoventa_create")
     * @Method("POST")
     * @Template("SmathClienteBundle:PuntoVenta:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new PuntoVenta();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('puntoventa'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a PuntoVenta entity.
     *
     * @param PuntoVenta $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(PuntoVenta $entity)
    {
        $form = $this->createForm(new PuntoVentaType(), $entity, array(
            'action' => $this->generateUrl('puntoventa_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear'));

        return $form;
    }

    /**
     * Displays a form to create a new PuntoVenta entity.
     *
     * @Route("/new", name="puntoventa_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new PuntoVenta();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a PuntoVenta entity.
     *
     * @Route("/{id}", name="puntoventa_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SmathClienteBundle:PuntoVenta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PuntoVenta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing PuntoVenta entity.
     *
     * @Route("/{id}/edit", name="puntoventa_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SmathClienteBundle:PuntoVenta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PuntoVenta entity.');
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
    * Creates a form to edit a PuntoVenta entity.
    *
    * @param PuntoVenta $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(PuntoVenta $entity)
    {
        $form = $this->createForm(new PuntoVentaType(), $entity, array(
            'action' => $this->generateUrl('puntoventa_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Guardar','attr'=>array('class'=>'btn btn-primary')));

        return $form;
    }
    /**
     * Edits an existing PuntoVenta entity.
     *
     * @Route("/{id}", name="puntoventa_update")
     * @Method("PUT")
     * @Template("SmathClienteBundle:PuntoVenta:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SmathClienteBundle:PuntoVenta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PuntoVenta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('puntoventa'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a PuntoVenta entity.
     *
     * @Route("/{id}", name="puntoventa_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SmathClienteBundle:PuntoVenta')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find PuntoVenta entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('puntoventa'));
    }

    /**
     * Creates a form to delete a PuntoVenta entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('puntoventa_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }

    /**
     * Return json a PuntoVenta where client id = $id .
     *
     * @Route("/{id}/select", name="puntoventa_select")
     * @Method("GET")
     */
    public function selectPuntoVenta($id) {

        $em = $this->getDoctrine()->getManager();
        $qb = $em->getRepository('SmathClienteBundle:PuntoVenta')->createQueryBuilder('pv')
            ->add('select', 'pv.id, pv.nombre as option')
            ->where('pv.cliente = ' . $id)
            ->andWhere('pv.estado = 1');
        $result = $qb->getQuery()->getResult();
        $response = new Response();
        $response->setContent(json_encode($result));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }


}
