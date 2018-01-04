<?php

namespace AppBundle\Controller;

use AppBundle\Entity\SanPham;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    /**
     * @Route("/index")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $products = $em->getRepository('AppBundle:SanPham')->findAll();
        return $this->render('product/index.html.twig', array('products' => $products,));
    }

    /**
     * @Route("/details/{id}")
     */
    public function detailsAction($id)
    {
      $em = $this->getDoctrine()->getManager();

      $product = $em->getRepository('AppBundle:SanPham')->find($id);
        return $this->render('product/details.html.twig', array(
            'product' => $product,
        ));
    }

}
