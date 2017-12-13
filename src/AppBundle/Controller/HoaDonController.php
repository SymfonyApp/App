<?php

namespace AppBundle\Controller;

use AppBundle\Entity\HoaDon;
use AppBundle\Entity\KhachHang;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Hoadon controller.
 *
 * @Route("hoadon")
 */
class HoaDonController extends Controller
{
    /**
     * Lists all hoaDon entities.
     *
     * @Route("/", name="bill_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $hoadon = $em->getRepository('AppBundle:HoaDon')->findAll();
                /**
         * 
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator  = $this->get('knp_paginator');
        $hoadons = $paginator->paginate(
            $hoadon,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',10)
        );

        return $this->render('hoadon/index.html.twig', array(
            'hoadons' => $hoadons,
        ));
    }

    /**
     * Finds and displays a hoaDon entity.
     *
     * @Route("/{id}", name="bill_show")
     * @Method("GET")
     */
    public function showAction(HoaDon $hoadon)
    {

        return $this->render('hoadon/show.html.twig', array(
            'hoadon' => $hoadon,
        ));
    }
}
