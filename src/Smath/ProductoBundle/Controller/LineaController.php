<?php

namespace Smath\ProductoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Smath\ProductoBundle\Entity\Linea;
use Smath\ProductoBundle\Form\LineaType;

/**
 * Linea controller.
 *
 * @Route("/linea")
 */
class LineaController extends Controller
{

    /**
     * Lists all Linea entities.
     *
     * @Route("/", name="linea")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SmathProductoBundle:Linea')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Lists all linea entities.
     *
     * @Route("/list", name="linea_list")
     * @Method("GET")
     */
    public function listAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $qb = $em->getRepository('SmathProductoBundle:Linea')->createQueryBuilder('l')
            ->add('select','l.id, l.codigo, l.descripcion, l.estado')
            ->orderBy('l.descripcion','ASC');
        $entities = $qb->getQuery()->getResult();
        $fields = array(
            'id' => 'l.id',
            'codigo' => 'l.codigo',
            'descripcion' => 'l.descripcion',
            'estado' => 'l.estado',
        );

        $paginator = $this->get('knp_paginator');
        $r = $this->get('smath_helpers')->jqGridJson($request, $em, $qb, $fields, $paginator);
        
        $response = new Response();    
        return $response->setContent($r);
    }

    /**
     * Creates a new Linea entity.
     *
     * @Route("/", name="linea_create")
     * @Method("POST")
     * @Template("SmathProductoBundle:Linea:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Linea();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('linea', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Linea entity.
     *
     * @param Linea $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Linea $entity)
    {
        $form = $this->createForm(new LineaType(), $entity, array(
            'action' => $this->generateUrl('linea_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Linea entity.
     *
     * @Route("/new", name="linea_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Linea();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Linea entity.
     *
     * @Route("/{id}", name="linea_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SmathProductoBundle:Linea')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Linea entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Linea entity.
     *
     * @Route("/{id}/edit", name="linea_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SmathProductoBundle:Linea')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Linea entity.');
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
    * Creates a form to edit a Linea entity.
    *
    * @param Linea $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Linea $entity)
    {
        $form = $this->createForm(new LineaType(), $entity, array(
            'action' => $this->generateUrl('linea_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Linea entity.
     *
     * @Route("/{id}", name="linea_update")
     * @Method("PUT")
     * @Template("SmathProductoBundle:Linea:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SmathProductoBundle:Linea')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Linea entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('linea', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Linea entity.
     *
     * @Route("/{id}", name="linea_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SmathProductoBundle:Linea')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Linea entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('linea'));
    }

    /**
     * Creates a form to delete a Linea entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('linea_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
