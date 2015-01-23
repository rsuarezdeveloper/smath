<?php

namespace Smath\ClienteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Smath\ClienteBundle\Entity\FormatoPuntoVenta;
use Smath\ClienteBundle\Form\FormatoPuntoVentaType;

/**
 * FormatoPuntoVenta controller.
 *
 * @Route("/formatopuntoventa")
 */
class FormatoPuntoVentaController extends Controller
{

    /**
     * Lists all FormatoPuntoVenta entities.
     *
     * @Route("/", name="formatopuntoventa")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SmathClienteBundle:FormatoPuntoVenta')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new FormatoPuntoVenta entity.
     *
     * @Route("/", name="formatopuntoventa_create")
     * @Method("POST")
     * @Template("SmathClienteBundle:FormatoPuntoVenta:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new FormatoPuntoVenta();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('formatopuntoventa_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a FormatoPuntoVenta entity.
     *
     * @param FormatoPuntoVenta $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(FormatoPuntoVenta $entity)
    {
        $form = $this->createForm(new FormatoPuntoVentaType(), $entity, array(
            'action' => $this->generateUrl('formatopuntoventa_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new FormatoPuntoVenta entity.
     *
     * @Route("/new", name="formatopuntoventa_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new FormatoPuntoVenta();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a FormatoPuntoVenta entity.
     *
     * @Route("/{id}", name="formatopuntoventa_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SmathClienteBundle:FormatoPuntoVenta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FormatoPuntoVenta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing FormatoPuntoVenta entity.
     *
     * @Route("/{id}/edit", name="formatopuntoventa_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SmathClienteBundle:FormatoPuntoVenta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FormatoPuntoVenta entity.');
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
    * Creates a form to edit a FormatoPuntoVenta entity.
    *
    * @param FormatoPuntoVenta $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(FormatoPuntoVenta $entity)
    {
        $form = $this->createForm(new FormatoPuntoVentaType(), $entity, array(
            'action' => $this->generateUrl('formatopuntoventa_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing FormatoPuntoVenta entity.
     *
     * @Route("/{id}", name="formatopuntoventa_update")
     * @Method("PUT")
     * @Template("SmathClienteBundle:FormatoPuntoVenta:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SmathClienteBundle:FormatoPuntoVenta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FormatoPuntoVenta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('formatopuntoventa_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a FormatoPuntoVenta entity.
     *
     * @Route("/{id}", name="formatopuntoventa_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SmathClienteBundle:FormatoPuntoVenta')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find FormatoPuntoVenta entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('formatopuntoventa'));
    }

    /**
     * Creates a form to delete a FormatoPuntoVenta entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('formatopuntoventa_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
