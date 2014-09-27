<?php

namespace Smath\CalendarioVisitaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Smath\CalendarioVisitaBundle\Entity\CalendarioVisita;
use Smath\CalendarioVisitaBundle\Form\CalendarioVisitaType;

/**
 * CalendarioVisita controller.
 *
 * @Route("/calendariovisita")
 */
class CalendarioVisitaController extends Controller
{

    /**
     * Lists all CalendarioVisita entities.
     *
     * @Route("/", name="calendariovisita")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SmathCalendarioVisitaBundle:CalendarioVisita')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Finds and displays a CalendarioVisita entity.
     *
     * @Route("/mapa", name="calendariovisita_mapa")
     * @Method("GET")
     * @Template()
     */
    public function mapaAction(){
        return array(
            'mapa'=>'mapa'
        );
    }

    /**
     * Creates a new CalendarioVisita entity.
     *
     * @Route("/", name="calendariovisita_create")
     * @Method("POST")
     * @Template("SmathCalendarioVisitaBundle:CalendarioVisita:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new CalendarioVisita();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('calendariovisita_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a CalendarioVisita entity.
     *
     * @param CalendarioVisita $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(CalendarioVisita $entity)
    {
        $form = $this->createForm(new CalendarioVisitaType(), $entity, array(
            'action' => $this->generateUrl('calendariovisita_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new CalendarioVisita entity.
     *
     * @Route("/new", name="calendariovisita_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new CalendarioVisita();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a CalendarioVisita entity.
     *
     * @Route("/{id}", name="calendariovisita_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SmathCalendarioVisitaBundle:CalendarioVisita')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CalendarioVisita entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing CalendarioVisita entity.
     *
     * @Route("/{id}/edit", name="calendariovisita_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SmathCalendarioVisitaBundle:CalendarioVisita')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CalendarioVisita entity.');
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
    * Creates a form to edit a CalendarioVisita entity.
    *
    * @param CalendarioVisita $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(CalendarioVisita $entity)
    {
        $form = $this->createForm(new CalendarioVisitaType(), $entity, array(
            'action' => $this->generateUrl('calendariovisita_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing CalendarioVisita entity.
     *
     * @Route("/{id}", name="calendariovisita_update")
     * @Method("PUT")
     * @Template("SmathCalendarioVisitaBundle:CalendarioVisita:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SmathCalendarioVisitaBundle:CalendarioVisita')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CalendarioVisita entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('calendariovisita_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a CalendarioVisita entity.
     *
     * @Route("/{id}", name="calendariovisita_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SmathCalendarioVisitaBundle:CalendarioVisita')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find CalendarioVisita entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('calendariovisita'));
    }

    /**
     * Creates a form to delete a CalendarioVisita entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('calendariovisita_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
