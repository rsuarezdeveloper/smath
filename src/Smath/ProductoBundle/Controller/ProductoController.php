<?php

namespace Smath\ProductoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Smath\ProductoBundle\Entity\Producto;
use Smath\ProductoBundle\Form\ProductoType;

/**
 * Producto controller.
 *
 * @Route("/producto")
 */
class ProductoController extends Controller
{

    /**
     * Lists all Producto entities.
     *
     * @Route("/", name="producto")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SmathProductoBundle:Producto')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Lists all producto entities.
     *
     * @Route("/list", name="producto_list")
     * @Method("GET")
     */
    public function listAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->getRepository('SmathProductoBundle:Producto')->createQueryBuilder('p')
        	   ->add('select','p.id, p.descripcion, p.estado, p.referencia, p.nombre, l.descripcion linea, p.precioUnidadComercial, p.precioFormaFarmaceutica')
        	   ->leftJoin('p.linea', 'l')
        	   ->orderBy('l.descripcion','ASC');
        $entities = $qb->getQuery()->getResult();
		$fields = array(
			'id' => 'p.id',
			'descripcion' => 'p.descripcion',
            'estado' => 'p.estado',
            'referencia' => 'p.referencia',
            'nombre' => 'p.nombre',
            'linea' => 'l.descripcion',
            'precioUnidadComercial' => 'p.precioUnidadComercial',
            'precioFormaFarmaceutica' => 'p.precioFormaFarmaceutica'
		);

        $paginator = $this->get('knp_paginator');
        $r = $this->get('smath_helpers')->jqGridJson($request, $em, $qb, $fields, $paginator);
        
        $response = new Response();    
        return $response->setContent($r);
    }
    
    /**
     * Creates a new Producto entity.
     *
     * @Route("/", name="producto_create")
     * @Method("POST")
     * @Template("SmathProductoBundle:Producto:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Producto();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('producto', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Producto entity.
     *
     * @param Producto $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Producto $entity) {
        $form = $this->createForm(new ProductoType(), $entity, array(
            'action' => $this->generateUrl('producto_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Producto entity.
     *
     * @Route("/new", name="producto_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction() {
        $entity = new Producto();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Producto entity.
     *
     * @Route("/{id}", name="producto_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SmathProductoBundle:Producto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Producto entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Producto entity.
     *
     * @Route("/{id}/edit", name="producto_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SmathProductoBundle:Producto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Producto entity.');
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
    * Creates a form to edit a Producto entity.
    *
    * @param Producto $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Producto $entity) {
        $form = $this->createForm(new ProductoType(), $entity, array(
            'action' => $this->generateUrl('producto_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Guardar'));

        return $form;
    }
    /**
     * Edits an existing Producto entity.
     *
     * @Route("/{id}", name="producto_update")
     * @Method("PUT")
     * @Template("SmathProductoBundle:Producto:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SmathProductoBundle:Producto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Producto entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('producto'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Producto entity.
     *
     * @Route("/{id}", name="producto_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id) {
        

        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        $sql = "DELETE FROM ProductoProveedor WHERE producto = $id";
        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SmathProductoBundle:Producto')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Producto entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('producto'));
    }

    /**
     * Creates a form to delete a Producto entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {

        return $this->createFormBuilder()
            ->setAction($this->generateUrl('producto_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar','attr' => array('class' => 'btn btn-danger')))
            ->getForm()
        ;
    }
}
