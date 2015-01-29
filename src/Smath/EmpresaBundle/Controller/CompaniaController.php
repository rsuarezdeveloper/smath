<?php

namespace Smath\EmpresaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Smath\EmpresaBundle\Entity\Compania;
use Smath\EmpresaBundle\Form\CompaniaType;

/**
 * Compania controller.
 *
 * @Route("/compania")
 */
class CompaniaController extends Controller
{

    /**
     * Lists all Compania entities.
     *
     * @Route("/", name="compania")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SmathEmpresaBundle:Compania')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Lists all Dos entities.
     *
     * @Route("/list", name="compania_list")
     * @Method("GET")
     */
    public function listAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->getRepository('SmathEmpresaBundle:Compania')->createQueryBuilder('c')
        	   ->add('select','c.id, c.codigo, c.nombre, c.telefono, c.estado, cf.nombre companiaId, gu.nombre geoUbicacion')
        	   ->leftJoin('c.companiaId','cf')
               ->leftJoin('c.geoUbicacion','gu')
        	   ->orderBy('c.nombre','ASC');
        $entities = $qb->getQuery()->getResult();
		$fields = array(
			'id' => 'c.id',
			'codigo'  =>  'c.codigo',
            'nombre' => 'c.nombre',
            'telefono' => 'c.telefono',
            'estado' => 'c.estado',
            'companiaId' => 'cf.nombre',
            'geoUbicacion' => 'gu.nombre'
		);

        $paginator = $this->get('knp_paginator');
        $r = $this->get('smath_helpers')->jqGridJson($request, $em, $qb, $fields, $paginator);
        
        $response = new Response();    
        return $response->setContent($r);
    }
    /**
     * Creates a new Compania entity.
     *
     * @Route("/", name="compania_create")
     * @Method("POST")
     * @Template("SmathEmpresaBundle:Compania:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Compania();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('compania_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Compania entity.
     *
     * @param Compania $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Compania $entity)
    {
        $form = $this->createForm(new CompaniaType(), $entity, array(
            'action' => $this->generateUrl('compania_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Compania entity.
     *
     * @Route("/new", name="compania_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Compania();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Compania entity.
     *
     * @Route("/{id}", name="compania_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SmathEmpresaBundle:Compania')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Compania entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Compania entity.
     *
     * @Route("/{id}/edit", name="compania_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SmathEmpresaBundle:Compania')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Compania entity.');
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
    * Creates a form to edit a Compania entity.
    *
    * @param Compania $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Compania $entity)
    {
        $form = $this->createForm(new CompaniaType(), $entity, array(
            'action' => $this->generateUrl('compania_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Compania entity.
     *
     * @Route("/{id}", name="compania_update")
     * @Method("PUT")
     * @Template("SmathEmpresaBundle:Compania:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SmathEmpresaBundle:Compania')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Compania entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('compania_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Compania entity.
     *
     * @Route("/{id}", name="compania_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SmathEmpresaBundle:Compania')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Compania entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('compania'));
    }

    /**
     * Creates a form to delete a Compania entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('compania_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
