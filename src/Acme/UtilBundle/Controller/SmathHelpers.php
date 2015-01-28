<?php 
namespace Acme\UtilBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class SmathHelpers extends Controller
{
    function jqGridJson($request, $em, $qb, $fields, $paginator)
    {        

		if ( $request->get('_search') && $request->get('_search') == 'true' && $request->get('filters') ) {
            $f = $request->get('filters');
            $f = json_decode(str_replace("\\", "", $f), true);
            $rules = $f['rules'];
            foreach($rules as $rule) {
                $searchField = $fields[$rule['field']];
                $searchString = $rule['data'];
                if($rule['field'] == 'fecha'){

                    $daterange = explode("|", $searchString);
                    if(count($daterange) == 1){
                    	$dateValue = "'" . trim(str_replace(" ", "", $daterange[0])) . "'";
                        $qb->andWhere($searchField . " =" . $dateValue);
                    } else {
                    	$minValue = "'" . trim(str_replace(" ", "", $daterange[0])) . "'";
                    	$maxValue = "'" . trim(str_replace(" ", "", $daterange[1])) . "'";
                        $qb->andWhere($qb->expr()->between($searchField, $minValue, $maxValue));
                    }

                } else {
                    if("null" != $searchString){
                    	$qb->andWhere($qb->expr()->like($searchField, $qb->expr()->literal("%" . $searchString . "%")));
                    }
                }
            }
        }

	    //Ordenamiento de columnas
	    //sidx	id
		//sord	desc
		$sidx = $request->get('sidx', 'id');
		$sord = $request->get('sord', 'ASC');

		$qb->orderBy($fields[$sidx], $sord);
	    $query = $qb->getQuery()->getResult();
		$pagination = $paginator->paginate(
		    $query,
		    $request->get('page', 1) /*page number*/,
		    $request->get('rows', 10) /*limit per page*/
		);
        
        $pdata = $pagination->getPaginationData();
        $r = array();
        $r['records'] = count($query);
        $r['page'] = $request->get('page', 1);
        $r['rows'] = array();
        $r['total'] = $pdata['pageCount'];

        foreach($pagination as $row){
	        $line = $row;
	      	$r['rows'][] = $line;
        }
        
        return json_encode($r);
    }
}