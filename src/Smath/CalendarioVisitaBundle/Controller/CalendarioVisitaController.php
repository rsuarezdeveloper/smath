<?php

namespace Smath\CalendarioVisitaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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

        return array(
            'citas' => "",
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
        $user = $this->get('security.context')->getToken()->getUser();
        $empleado = $user->getEmpleado();
        $hoy = new \DateTime();
        $em = $this->getDoctrine()->getManager();
        $qb = $em->getRepository('SmathCalendarioVisitaBundle:CalendarioVisita')->createQueryBuilder('c')
            ->leftJoin('c.empleado','e')
            //->leftJoin('c.puntoVenta','pv')
            ;
        $qb->Where("c.fechaProgramada LIKE '".$hoy->format('Y-m-d')."%'");
        if(null!=$empleado){
            $qb->andWhere('e.id='.$empleado->getId());
        }
        //die($qb->getQuery()->getSQL());
        $citas = $qb->getQuery()->getResult();
        return array(
            'citas' => $citas,
        );
    }
    /**
     * Finds and displays a CalendarioVisita entity.
     *
     * @Route("/calendario", name="calendariovisita_calendario")
     * @Method("GET")
     * @Template()
     */
    public function calendarioAction(){
        $user = $this->get('security.context')->getToken()->getUser();
        $empleado = $user->getEmpleado();
        $em = $this->getDoctrine()->getManager();
        $qb = $em->getRepository('SmathEmpresaBundle:EmpleadoCliente')->createQueryBuilder('ec')
            ->add('select','c.razonSocial, c.numeroDocumento')
            ->leftJoin('ec.cliente','c')
            ->leftJoin('ec.empleado','e')
            //->leftJoin('c.puntoVenta','pv')
            ;
        //$qb->Where("c.fechaProgramada LIKE '".$hoy->format('Y-m-d')."%'");
        if(null!=$empleado){
            $qb->Where('e.id='.$empleado->getId());
        }
        //die($qb->getQuery()->getSQL());
        $clientes = $qb->getQuery()->getResult();
        return array(
            'clientes' => $clientes,
        );
    }
    /**
     * Finds and displays a CalendarioVisita entity.
     *
     * @Route("/misclientes", name="calendariovisita_misclientes")
     * @Method("GET")
     * @Template()
     */
    public function misclientesAction(){
        $user = $this->get('security.context')->getToken()->getUser();
        $empleado = $user->getEmpleado();
        $em = $this->getDoctrine()->getManager();
        $qb = $em->getRepository('SmathEmpresaBundle:EmpleadoCliente')->createQueryBuilder('ec')
            ->add('select','c.razonSocial, c.numeroDocumento')
            ->leftJoin('ec.cliente','c')
            ->leftJoin('ec.empleado','e')
            //->leftJoin('c.puntoVenta','pv')
            ;
        //$qb->Where("c.fechaProgramada LIKE '".$hoy->format('Y-m-d')."%'");
        if(null!=$empleado){
            $qb->Where('e.id='.$empleado->getId());
        }
        //die($qb->getQuery()->getSQL());
        $clientes = $qb->getQuery()->getResult();
        return array(
            'clientes' => $clientes,
        );
    }
    /**
     * Finds and displays a CalendarioVisita entity.
     *
     * @Route("/gmap", name="calendariovisita_gmap")
     * @Method("GET")
     * @Template()
     */
    public function gmapAction(){
        $user = $this->get('security.context')->getToken()->getUser();
        $empleado = $user->getEmpleado();
        $hoy = new \DateTime();
        $em = $this->getDoctrine()->getManager();
        $qb = $em->getRepository('SmathCalendarioVisitaBundle:CalendarioVisita')->createQueryBuilder('c')
            ->leftJoin('c.empleado','e')
            ->leftJoin('c.puntoVenta','pv')
            ;
        $qb->Where("c.fechaProgramada LIKE '".$hoy->format('Y-m-d')."%'");
        if(null!=$empleado){
            $qb->andWhere('e.id='.$empleado->getId());
        }
        //die($qb->getQuery()->getSQL());
        $citas = $qb->getQuery()->getResult();
        return array(
            'citas' => $citas,
        );
    }
    /**
     * Finds and displays a CalendarioVisita entity.
     *
     * @Route("/mensaje", name="calendariovisita_mensaje")
     * @Method("GET")
     * @Template()
     */
    public function mensajeAction(){
        $user = $this->get('security.context')->getToken()->getUser();
        $empleado = $user->getEmpleado();
        $em = $this->getDoctrine()->getManager();
        $qb = $em->getRepository('SmathCalendarioVisitaBundle:Mensaje')->createQueryBuilder('m')
            ->add('select','m.mensaje, m.fecha, m.leido, et.nombre as NombreDe, ef.nombre as NombrePara')
            ->leftJoin('m.empleado','et')
            ->leftJoin('m.empleadoId','ef')
            ;
        //$qb->Where("c.fechaProgramada LIKE '".$hoy->format('Y-m-d')."%'");
        if(null!=$empleado){
            $qb->Where('et.id='.$empleado->getId().' OR ef.id='.$empleado->getId());
            #$qb->andWhere('et.id='.$empleado->getId().' OR ef.id='.$empleado->getId());
        }
        $qb->orderBy('m.fecha', 'DESC');
        //die($qb->getQuery()->getSQL());
        $mensajes = $qb->getQuery()->getResult();
        return array(
            'mensajes' => $mensajes,
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
     * @Method("POST")
     * @Template("SmathCalendarioVisitaBundle:CalendarioVisita:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.context')->getToken()->getUser();
        $empleado = $user->getEmpleado();
        $entity = $em->getRepository('SmathCalendarioVisitaBundle:CalendarioVisita')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CalendarioVisita entity.');
        }
        if($request->isXMLHttpRequest()){
            $observaciones = $request->get('observaciones');
            $entity->setObservaciones($observaciones);
            $entity->setFechaVisita(new \DateTime());
            $entity->setVisitado(true);
            $em->persist($entity);
            $em->flush();
            $response = new Response(json_encode(array('success'=>true)));

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
