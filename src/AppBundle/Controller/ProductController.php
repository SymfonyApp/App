<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ProductController extends Controller
{
    /**
     * @Route("/index")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $product = $em->getRepository('AppBundle:User')->findAll();
        /**
        *@var $paginator \Knp\Component\Pager\Paginator
        */
        $paginator = $this->get('knp_paginator');
        $products = $paginator->paginate($product,
        $request->query->getInt('page',1),
        $request->query->getInt('limit',10));
        return $this->render('product/index.html.twig', array('products'=>$products));
    }

    /**
     * @Route("/details/{id}")
     */
    public function detailsAction($id)
    {
        return $this->render('product/details.html.twig', array(
            // ...
        ));
    }

}
