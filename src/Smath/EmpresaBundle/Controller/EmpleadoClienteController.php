<?php

namespace Smath\EmpresaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Smath\EmpresaBundle\Entity\EmpleadoCliente;
use Smath\EmpresaBundle\Form\EmpleadoClienteType;

/**
 * EmpleadoCliente controller.
 *
 * @Route("/empleadocliente")
 */
class EmpleadoClienteController extends Controller
{

    /**
     * Lists all EmpleadoCliente entities.
     *
     * @Route("/", name="empleadocliente")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SmathEmpresaBundle:EmpleadoCliente')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Lists all Dos entities.
     *
     * @Route("/list", name="empleadocliente_list")
     * @Method("GET")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->getRepository('SmathEmpresaBundle:EmpleadoCliente')->createQueryBuilder('ec')
        	   ->add('select','ec.id, ec.fechaAsignacion, ec.estado, ec.metaVisitasMes, ec.metaVentasMes, c.razonSocial cliente, e.nombre empleado ,pv.nombre puntoVenta') #pv.nombre puntoVenta,
        	   ->leftJoin('ec.cliente','c')
               ->leftJoin('ec.puntoVenta','pv')
               ->leftJoin('ec.empleado','e')
        	   ->orderBy('e.nombre','ASC');
        $entities=$qb->getQuery()->getResult();
		$fields=array(
			'id'=>'ec.id',
			'fechaAsignacion' => 'ec.fechaAsignacion',
            'estado'=>'ec.estado',
            'metaVisitasMes'=>'ec.metaVisitasMes',
            'metaVentasMes'=>'ec.metaVentasMes',
            'cliente'=>'c.razonSocial',
            'puntoVenta'=>'pv.nombre',
            'empleado'=>'e.nombre'
			);

		///Aplicamos filtros
	    $request=$this->get('request');
	    if ( $request->get('_search') && $request->get('_search') == "true" && $request->get('filters') )
            {
                    $f=$request->get('filters');
                    $f=json_decode(str_replace("\\","",$f),true);
                    $rules=$f['rules'];
                    foreach($rules as $rule){
                            $searchField=$fields[$rule['field']];
                            $searchString=$rule['data'];
                            if($rule['field']=='fecha'){
                            $daterange=explode("|", $searchString);
                            if(count($daterange)==1){
                            	$dateValue="'".trim(str_replace(" ","",$daterange[0]))."'";
	                            $qb->andWhere($searchField." =".$dateValue);
                            }else{
                            	$minValue="'".trim(str_replace(" ","",$daterange[0]))."'";
                            	$maxValue="'".trim(str_replace(" ","",$daterange[1]))."'";
	                            $qb->andWhere($qb->expr()->between($searchField,$minValue , $maxValue));
                            }

                            }else{
                                if("null"!=$searchString){
                                	$qb->andWhere($qb->expr()->like($searchField, $qb->expr()->literal("%".$searchString."%")));
                                }
                            }
                    }

            }


	    //Ordenamiento de columnas
	    //sidx	id
		//sord	desc
		$sidx=$this->get('request')->query->get('sidx', 'id');
		$sord=$this->get('request')->query->get('sord', 'DESC');
		$qb->orderBy($fields[$sidx],$sord);


	    $query=$qb->getQuery()->getResult();
		$paginator = $this->get('knp_paginator');
		$pagination = $paginator->paginate(
		    $query,
		    $this->get('request')->query->get('page', 1)/*page number*/,
		   $this->get('request')->query->get('rows', 10)/*limit per page*/
		);
        /*return array(
            'entities' => $entities,
            'pagination'=>$pagination
        );*/
        $response= new Response();
        $pdata=$pagination->getPaginationData();
        $r=array();
        $r['records']=count($query);
        $r['page']=$this->get('request')->query->get('page', 1);
        $r['rows']=array();
        $r['total'] = $pdata['pageCount'];

        foreach($pagination as $row){
	        $line=$row;
	      	$r['rows'][]=$line;
        }
        $response->setContent(json_encode($r));
        return $response;
    }
    /**
     * Creates a new EmpleadoCliente entity.
     *
     * @Route("/", name="empleadocliente_create")
     * @Method("POST")
     * @Template("SmathEmpresaBundle:EmpleadoCliente:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new EmpleadoCliente();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('empleadocliente_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a EmpleadoCliente entity.
     *
     * @param EmpleadoCliente $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(EmpleadoCliente $entity)
    {
        $form = $this->createForm(new EmpleadoClienteType(), $entity, array(
            'action' => $this->generateUrl('empleadocliente_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new EmpleadoCliente entity.
     *
     * @Route("/new", name="empleadocliente_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new EmpleadoCliente();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a EmpleadoCliente entity.
     *
     * @Route("/{id}", name="empleadocliente_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SmathEmpresaBundle:EmpleadoCliente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EmpleadoCliente entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing EmpleadoCliente entity.
     *
     * @Route("/{id}/edit", name="empleadocliente_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SmathEmpresaBundle:EmpleadoCliente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EmpleadoCliente entity.');
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
    * Creates a form to edit a EmpleadoCliente entity.
    *
    * @param EmpleadoCliente $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(EmpleadoCliente $entity)
    {
        $form = $this->createForm(new EmpleadoClienteType(), $entity, array(
            'action' => $this->generateUrl('empleadocliente_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing EmpleadoCliente entity.
     *
     * @Route("/{id}", name="empleadocliente_update")
     * @Method("PUT")
     * @Template("SmathEmpresaBundle:EmpleadoCliente:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SmathEmpresaBundle:EmpleadoCliente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EmpleadoCliente entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('empleadocliente_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a EmpleadoCliente entity.
     *
     * @Route("/{id}", name="empleadocliente_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SmathEmpresaBundle:EmpleadoCliente')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find EmpleadoCliente entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('empleadocliente'));
    }

    /**
     * Creates a form to delete a EmpleadoCliente entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('empleadocliente_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
