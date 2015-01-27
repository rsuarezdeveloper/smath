<?php

namespace Smath\ClienteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Smath\ClienteBundle\Entity\TipoCliente;
use Smath\ClienteBundle\Form\TipoClienteType;

/**
 * TipoCliente controller.
 *
 * @Route("/tipocliente")
 */
class TipoClienteController extends Controller
{

    /**
     * Lists all TipoCliente entities.
     *
     * @Route("/", name="tipocliente")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SmathClienteBundle:TipoCliente')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    
    /**
     * Lists all producto entities.
     *
     * @Route("/list", name="producto_list")
     * @Method("GET")
     */
    public function listAction () 
    {
    
        $em = $this->getDoctrine()->getManager();
        $qb = $em->getRepository('SmathProductoBundle:TipoCliente')->createQueryBuilder('p')
               ->add('select','p.id, p.descripcion, p.estado, p.referencia, p.nombre, l.descripcion linea, p.precioUnidadComercial, p.precioFormaFarmaceutica')
               ->leftJoin('p.linea', 'l')
               ->orderBy('l.descripcion','ASC');
        $entities = $qb->getQuery()->getResult();
        $fields = array(
            'id' => 'p.id',
            'descripcion' => 'p.descripcion',
            'estado' => 'p.estado',
            'referencia' => 'p.referencia',
            'nombre' => 'p.nombre',
            'linea' => 'l.descripcion',
            'precioUnidadComercial' => 'p.precioUnidadComercial',
            'precioFormaFarmaceutica' => 'p.precioFormaFarmaceutica'
        );

        ///Aplicamos filtros
        $request = $this->get('request');
        if ($request->get('_search') && $request->get('_search') == "true" && $request->get('filters')) {
            $f = $request->get('filters');
            $f = json_decode(str_replace("\\", "", $f), true);
            $rules = $f['rules'];
            foreach($rules as $rule){
                $searchField = $fields[$rule['field']];
                $searchString = $rule['data'];

                if($rule['field'] == 'fecha'){
                
                    $daterange = explode("|", $searchString);
                    if(count($daterange) == 1){
                        $dateValue = "'" . trim(str_replace(" ", "", $daterange[0])) . "'";
                        $qb->andWhere($searchField." =".$dateValue);
                    } else {
                        $minValue = "'" . trim(str_replace(" ", "", $daterange[0])) . "'";
                        $maxValue = "'" . trim(str_replace(" ", "", $daterange[1])) . "'";
                        $qb->andWhere($qb->expr()->between($searchField,$minValue , $maxValue));
                    }

                } else {
                    if("null" != $searchString){
                        $qb->andWhere($qb->expr()->like($searchField, $qb->expr()->literal("%" . $searchString . "%")));
                    }
                }
            }
        }

        //Ordenamiento de columnas
        //sidx  id
        //sord  desc
        $sidx = $this->get('request')->query->get('sidx', 'id');
        $sord = $this->get('request')->query->get('sord', 'DESC');
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
        $response = new Response();
        $pdata = $pagination->getPaginationData();
        $r = array();
        $r['records'] = count($query);
        $r['page'] = $this->get('request')->query->get('page', 1);
        $r['rows'] = array();
        $r['total'] = $pdata['pageCount'];

        foreach($pagination as $row){
            $line = $row;
            $r['rows'][] = $line;
        }
        $response->setContent(json_encode($r));
        return $response;

    }

    /**
     * Creates a new TipoCliente entity.
     *
     * @Route("/", name="tipocliente_create")
     * @Method("POST")
     * @Template("SmathClienteBundle:TipoCliente:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new TipoCliente();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tipocliente_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a TipoCliente entity.
     *
     * @param TipoCliente $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TipoCliente $entity)
    {
        $form = $this->createForm(new TipoClienteType(), $entity, array(
            'action' => $this->generateUrl('tipocliente_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new TipoCliente entity.
     *
     * @Route("/new", name="tipocliente_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new TipoCliente();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a TipoCliente entity.
     *
     * @Route("/{id}", name="tipocliente_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SmathClienteBundle:TipoCliente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoCliente entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing TipoCliente entity.
     *
     * @Route("/{id}/edit", name="tipocliente_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SmathClienteBundle:TipoCliente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoCliente entity.');
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
    * Creates a form to edit a TipoCliente entity.
    *
    * @param TipoCliente $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TipoCliente $entity)
    {
        $form = $this->createForm(new TipoClienteType(), $entity, array(
            'action' => $this->generateUrl('tipocliente_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing TipoCliente entity.
     *
     * @Route("/{id}", name="tipocliente_update")
     * @Method("PUT")
     * @Template("SmathClienteBundle:TipoCliente:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SmathClienteBundle:TipoCliente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoCliente entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('tipocliente_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a TipoCliente entity.
     *
     * @Route("/{id}", name="tipocliente_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SmathClienteBundle:TipoCliente')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TipoCliente entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tipocliente'));
    }

    /**
     * Creates a form to delete a TipoCliente entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tipocliente_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
