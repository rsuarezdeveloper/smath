<?php

namespace Smath\EmpresaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Smath\EmpresaBundle\Entity\CompaniaCliente;
use Smath\EmpresaBundle\Form\CompaniaClienteType;

/**
 * CompaniaCliente controller.
 *
 * @Route("/companiacliente")
 */
class CompaniaClienteController extends Controller
{

    /**
     * Lists all CompaniaCliente entities.
     *
     * @Route("/", name="companiacliente")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SmathEmpresaBundle:CompaniaCliente')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Lists all Dos entities.
     *
     * @Route("/list", name="companiacliente_list")
     * @Method("GET")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->getRepository('SmathEmpresaBundle:CompaniaCliente')->createQueryBuilder('cc')
        	   ->add('select','cc.id, cc.fechaIngreso, cc.estado, cl.razonSocial cliente, co.nombre compania, e.nombre empleado')
        	   ->leftJoin('cc.cliente','cl')
               ->leftJoin('cc.compania','co')
               ->leftJoin('cc.empleado','e')
        	   ->orderBy('co.nombre','ASC');
        $entities=$qb->getQuery()->getResult();
		$fields=array(
			'id'=>'cc.id',
			'fechaIngreso' => 'cc.fechaIngreso',
            'estado'=>'cc.estado',
            'cliente'=>'cl.razonSocial',
            'compania'=>'co.nombre',
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
     * Creates a new CompaniaCliente entity.
     *
     * @Route("/", name="companiacliente_create")
     * @Method("POST")
     * @Template("SmathEmpresaBundle:CompaniaCliente:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new CompaniaCliente();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('companiacliente_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a CompaniaCliente entity.
     *
     * @param CompaniaCliente $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(CompaniaCliente $entity)
    {
        $form = $this->createForm(new CompaniaClienteType(), $entity, array(
            'action' => $this->generateUrl('companiacliente_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new CompaniaCliente entity.
     *
     * @Route("/new", name="companiacliente_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new CompaniaCliente();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a CompaniaCliente entity.
     *
     * @Route("/{id}", name="companiacliente_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SmathEmpresaBundle:CompaniaCliente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CompaniaCliente entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing CompaniaCliente entity.
     *
     * @Route("/{id}/edit", name="companiacliente_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SmathEmpresaBundle:CompaniaCliente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CompaniaCliente entity.');
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
    * Creates a form to edit a CompaniaCliente entity.
    *
    * @param CompaniaCliente $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(CompaniaCliente $entity)
    {
        $form = $this->createForm(new CompaniaClienteType(), $entity, array(
            'action' => $this->generateUrl('companiacliente_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing CompaniaCliente entity.
     *
     * @Route("/{id}", name="companiacliente_update")
     * @Method("PUT")
     * @Template("SmathEmpresaBundle:CompaniaCliente:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SmathEmpresaBundle:CompaniaCliente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CompaniaCliente entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('companiacliente_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a CompaniaCliente entity.
     *
     * @Route("/{id}", name="companiacliente_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SmathEmpresaBundle:CompaniaCliente')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find CompaniaCliente entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('companiacliente'));
    }

    /**
     * Creates a form to delete a CompaniaCliente entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('companiacliente_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
