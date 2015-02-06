<?php

namespace Smath\VentasBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Smath\VentasBundle\Entity\PedidoProducto;
use Smath\VentasBundle\Form\PedidoProductoType;

/**
 * PedidoProducto controller.
 *
 * @Route("/pedidoproducto")
 */
class PedidoProductoController extends Controller
{

    /**
     * Lists all PedidoProducto entities.
     *
     * @Route("/", name="pedidoproducto")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SmathVentasBundle:PedidoProducto')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Lists all pedidoproducto entities.
     *
     * @Route("/list", name="pedidoproducto_list")
     * @Method("GET")
     */
    public function listAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $qb = $em->getRepository('SmathVentasBundle:PedidoProducto')->createQueryBuilder('pp')
            ->add('select','pp.id, prod.nombre, prod.referencia, pp.cantidad, pp.valorUnidad, pp.valorTotal')
            ->join('pp.pedido','p')
            ->join('pp.producto','prod');

        $entities = $qb->getQuery()->getResult();
        $fields = array(
            'id' => 'pp.id',
            'producto' => 'prod.nombre',
            'referencia' => 'prod.referencia',
            'cantidad' => 'pp.cantidad',
            'valorUnidad' => 'pp.valorUnidad',
            'valorTotal' => 'pp.valorTotal'

        );

        $paginator = $this->get('knp_paginator');
        $r = $this->get('smath_helpers')->jqGridJson($request, $em, $qb, $fields, $paginator);
        
        $response = new Response();    
        return $response->setContent($r);
    }
    /**
     * Creates a new PedidoProducto entity.
     *
     * @Route("/", name="pedidoproducto_create")
     * @Method("POST")
     * @Template("SmathVentasBundle:PedidoProducto:new.html.twig")
     */
    public function createAction(Request $request)
    {        
        
        $entity = new PedidoProducto();

        // set values from product table
        
        $post = $request->get('smath_ventasbundle_pedidoproducto');
        
        $em = $this->getDoctrine()->getManager();
        $producto = $em->getRepository('SmathProductoBundle:Producto')->find($post['producto']);
        
        $entity->setValorUnidad($producto->getPrecioUnidadComercial());
        $entity->setValorTotal($producto->getPrecioUnidadComercial() * $post['cantidad']);
        // done setting
        
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return new Response(json_encode(array('success' => 'true')));
            return $this->redirect($this->generateUrl('pedido_edit', array('id' => $post['pedido'])));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
        
    }

    /**
     * Creates a form to create a PedidoProducto entity.
     *
     * @param PedidoProducto $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(PedidoProducto $entity)
    {
        $form = $this->createForm(new PedidoProductoType(), $entity, array(
            'action' => $this->generateUrl('pedidoproducto_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new PedidoProducto entity.
     *
     * @Route("/new", name="pedidoproducto_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction(Request $request)
    {

        $entity = new PedidoProducto();
        
        $pedidoId = $request->get('pedidoId');
        $em = $this->getDoctrine()->getManager();
        $pedido = $em->getRepository('SmathVentasBundle:Pedido')->find($pedidoId);
        $entity->setPedido($pedido);
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a PedidoProducto entity.
     *
     * @Route("/{id}", name="pedidoproducto_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SmathVentasBundle:PedidoProducto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PedidoProducto entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing PedidoProducto entity.
     *
     * @Route("/{id}/edit", name="pedidoproducto_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SmathVentasBundle:PedidoProducto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PedidoProducto entity.');
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
    * Creates a form to edit a PedidoProducto entity.
    *
    * @param PedidoProducto $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(PedidoProducto $entity)
    {
        $form = $this->createForm(new PedidoProductoType(), $entity, array(
            'action' => $this->generateUrl('pedidoproducto_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing PedidoProducto entity.
     *
     * @Route("/{id}", name="pedidoproducto_update")
     * @Method("PUT")
     * @Template("SmathVentasBundle:PedidoProducto:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SmathVentasBundle:PedidoProducto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PedidoProducto entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('pedidoproducto_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a PedidoProducto entity.
     *
     * @Route("/{id}", name="pedidoproducto_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SmathVentasBundle:PedidoProducto')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find PedidoProducto entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('pedidoproducto'));
    }

    /**
     * Creates a form to delete a PedidoProducto entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pedidoproducto_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
