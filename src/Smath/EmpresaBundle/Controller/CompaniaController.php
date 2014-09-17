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
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->getRepository('SmathEmpresaBundle:Compania')->createQueryBuilder('c')
        	   ->add('select','c.id, c.codigo, c.nombre, c.telefono, c.estado, cf.nombre companiaId, gu.nombre geoUbicacion')
        	   ->leftJoin('c.companiaId','cf')
               ->leftJoin('c.geoUbicacion','gu')
        	   ->orderBy('c.nombre','ASC');
        $entities=$qb->getQuery()->getResult();
		$fields=array(
			'id'=>'c.id',
			'codigo' => 'c.codigo',
            'nombre'=>'c.nombre',
            'telefono'=>'c.telefono',
            'estado'=>'c.estado',
            'companiaId'=>'cf.nombre',
            'geoUbicacion' => 'gu.nombre'
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
