<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Khachhang controller.
 *
 * @Route("doanhthu")
 */
class DoanhThuController extends Controller
{
    /**
     * 
     *
     * @Route("/nam", name="doanhthu_nam")
     * 
     */
    public function yearAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $serializer = $this->get('jms_serializer');
        $date = new \DateTime();
        $year= $date->format('Y');
        if($request->getMethod()=="POST")
        {
            $year= $request->request->getInt('_year');
        }
        
        $thongke = $doanhthu = $em->getRepository('AppBundle:HoaDon')->DoanhThuNam($year);
        $doanhthu = $serializer->serialize($thongke, 'json');
        return $this->render('doanhthu/doanhthu.html.twig',array('doanhthu'=>$doanhthu, 'nam'=>$year));    
    }

}
