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
        return $this->render('product/index.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/details/{id}")
     */
    public function detailsAction($id)
    {
        return $this->render('AppBundle:Product:details.html.twig', array(
            // ...
        ));
    }

}
