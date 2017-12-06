<?php

namespace AppBundle\Controller;

use AppBundle\Entity\LoaiSP;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Loaisp controller.
 *
 * @Route("loaisp")
 */
class LoaiSPController extends Controller
{
    /**
     * Lists all loaiSP entities.
     *
     * @Route("/", name="loaisp_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $loaiSPs = $em->getRepository('AppBundle:LoaiSP')->findAll();

        return $this->render('loaisp/index.html.twig', array(
            'loaiSPs' => $loaiSPs,
        ));
    }

    /**
     * Finds and displays a loaiSP entity.
     *
     * @Route("/{id}", name="loaisp_show")
     * @Method("GET")
     */
    public function showAction(LoaiSP $loaiSP)
    {

        return $this->render('loaisp/show.html.twig', array(
            'loaiSP' => $loaiSP,
        ));
    }
}
