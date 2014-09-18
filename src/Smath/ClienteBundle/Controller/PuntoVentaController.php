<?php

namespace Smath\ClienteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Smath\ClienteBundle\Entity\PuntoVenta;
use Smath\ClienteBundle\Form\PuntoVentaType;

/**
 * PuntoVenta controller.
 *
 * @Route("/puntoventa")
 */
class PuntoVentaController extends Controller
{

    /**
     * Lists all PuntoVenta entities.
     *
     * @Route("/", name="puntoventa")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SmathClienteBundle:PuntoVenta')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Lists all PuntoVenta entities.
     *
     * @Route("/list", name="puntoventa_list")
     * @Method("GET")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->getRepository('SmathClienteBundle:PuntoVenta')->createQueryBuilder('pv')
        	   ->add('select','pv.id, c.razonSocial cliente, pv.nombre, pv.numerodocumento, pv.direccion, pv.telefono1, pv.correoelectronico')
        	   ->leftJoin('pv.cliente','c')
        	   ;
        $entities=$qb->getQuery()->getResult();
		$fields=array(
			'id'=>'pv.id',
			'cliente' => 'c.razonSocial',
            'nombre'=>'pv.nombre',
            'numerodocumento'=>'pv.numerodocumento',
            'direccion'=>'pv.direccion',
            'telefono1'=>'pv.telefono1',
            'correoelectronico' => 'pv.correoelectronico'
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
		$sidx=$this->get('request')->query->get('sidx', 'cliente');
		$sord=$this->get('request')->query->get('sord', 'ASC');
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
     * Creates a new PuntoVenta entity.
     *
     * @Route("/", name="puntoventa_create")
     * @Method("POST")
     * @Template("SmathClienteBundle:PuntoVenta:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new PuntoVenta();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('puntoventa_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a PuntoVenta entity.
     *
     * @param PuntoVenta $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(PuntoVenta $entity)
    {
        $form = $this->createForm(new PuntoVentaType(), $entity, array(
            'action' => $this->generateUrl('puntoventa_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear'));

        return $form;
    }

    /**
     * Displays a form to create a new PuntoVenta entity.
     *
     * @Route("/new", name="puntoventa_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new PuntoVenta();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a PuntoVenta entity.
     *
     * @Route("/{id}", name="puntoventa_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SmathClienteBundle:PuntoVenta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PuntoVenta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing PuntoVenta entity.
     *
     * @Route("/{id}/edit", name="puntoventa_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SmathClienteBundle:PuntoVenta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PuntoVenta entity.');
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
    * Creates a form to edit a PuntoVenta entity.
    *
    * @param PuntoVenta $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(PuntoVenta $entity)
    {
        $form = $this->createForm(new PuntoVentaType(), $entity, array(
            'action' => $this->generateUrl('puntoventa_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Guardar','attr'=>array('class'=>'btn btn-primary')));

        return $form;
    }
    /**
     * Edits an existing PuntoVenta entity.
     *
     * @Route("/{id}", name="puntoventa_update")
     * @Method("PUT")
     * @Template("SmathClienteBundle:PuntoVenta:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SmathClienteBundle:PuntoVenta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PuntoVenta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('puntoventa_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a PuntoVenta entity.
     *
     * @Route("/{id}", name="puntoventa_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SmathClienteBundle:PuntoVenta')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find PuntoVenta entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('puntoventa'));
    }

    /**
     * Creates a form to delete a PuntoVenta entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('puntoventa_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
