<?php

namespace Smath\BaseBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Smath\BaseBundle\Entity\TipoGeoUbicacion;
use Smath\BaseBundle\Form\TipoGeoUbicacionType;

/**
 * TipoGeoUbicacion controller.
 *
 * @Route("/tipogeoubicacion")
 */
class TipoGeoUbicacionController extends Controller
{

    /**
     * Lists all TipoGeoUbicacion entities.
     *
     * @Route("/", name="tipogeoubicacion")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SmathBaseBundle:TipoGeoUbicacion')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Lists all Dos entities.
     *
     * @Route("/list", name="tipogeoubicacion_list")
     * @Method("GET")
     */
    public function listAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->getRepository('SmathBaseBundle:TipoGeoUbicacion')->createQueryBuilder('tg')
        	   ->add('select','tg.id, tg.nombre, tg.estado')
        	   ->orderBy('tg.nombre','ASC');
        $entities=$qb->getQuery()->getResult();
		
        $fields = array(
			'id' => 'tg.id',
			'nombre' => 'tg.nombre',
            'estado' => 'tg.estado'
		);

		$paginator = $this->get('knp_paginator');
        $r = $this->get('smath_helpers')->jqGridJson($request, $em, $qb, $fields, $paginator);
    }
    /**
     * Creates a new TipoGeoUbicacion entity.
     *
     * @Route("/", name="tipogeoubicacion_create")
     * @Method("POST")
     * @Template("SmathBaseBundle:TipoGeoUbicacion:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new TipoGeoUbicacion();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tipogeoubicacion_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a TipoGeoUbicacion entity.
     *
     * @param TipoGeoUbicacion $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TipoGeoUbicacion $entity)
    {
        $form = $this->createForm(new TipoGeoUbicacionType(), $entity, array(
            'action' => $this->generateUrl('tipogeoubicacion_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new TipoGeoUbicacion entity.
     *
     * @Route("/new", name="tipogeoubicacion_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new TipoGeoUbicacion();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a TipoGeoUbicacion entity.
     *
     * @Route("/{id}", name="tipogeoubicacion_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SmathBaseBundle:TipoGeoUbicacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoGeoUbicacion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing TipoGeoUbicacion entity.
     *
     * @Route("/{id}/edit", name="tipogeoubicacion_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SmathBaseBundle:TipoGeoUbicacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoGeoUbicacion entity.');
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
    * Creates a form to edit a TipoGeoUbicacion entity.
    *
    * @param TipoGeoUbicacion $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TipoGeoUbicacion $entity)
    {
        $form = $this->createForm(new TipoGeoUbicacionType(), $entity, array(
            'action' => $this->generateUrl('tipogeoubicacion_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing TipoGeoUbicacion entity.
     *
     * @Route("/{id}", name="tipogeoubicacion_update")
     * @Method("PUT")
     * @Template("SmathBaseBundle:TipoGeoUbicacion:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SmathBaseBundle:TipoGeoUbicacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoGeoUbicacion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('tipogeoubicacion_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a TipoGeoUbicacion entity.
     *
     * @Route("/{id}", name="tipogeoubicacion_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SmathBaseBundle:TipoGeoUbicacion')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TipoGeoUbicacion entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tipogeoubicacion'));
    }

    /**
     * Creates a form to delete a TipoGeoUbicacion entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tipogeoubicacion_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
