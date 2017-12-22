<?php

namespace AppBundle\Controller;

use AppBundle\Entity\HoaDon;
use AppBundle\Entity\SanPham;
use AppBundle\Entity\KhachHang;
use AppBundle\Entity\ChiTietHD;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Hoadon controller.
 *
 * @Route("hoadon")
 */
class HoaDonController extends Controller
{
    /**
     * Add product to bill
     * @Route("/add", name="bill_add_product")
     * @Method({"GET", "POST"})
     *
     */
    public function AddProductToBillAction(Request $request)
    {
        // session ds sản phẩm mua trong hóa đơn
        // sau mỗi lần thêm thì danh sách sẽ tăng thêm
        $session = new Session();
        $em = $this->getDoctrine()->getManager();
        $tmp= array();
        $tmp = $session->get('cthd');
        $sanpham = $em->getRepository('AppBundle:SanPham')->findOneById($request->request->get('_idsp'));
        $chitiet=new ChiTietHD();
            $chitiet->setSl($request->request->get('_sl'));
            $chitiet->setTensp($sanpham->getTensp());
            $chitiet->setDongia($sanpham->getGia());
            $chitiet->setThanhtien($sanpham->getGia()*$request->request->get('_sl'));
            $chitiet->setSP($sanpham);
        $tmp[count($tmp)]= $chitiet;
        $session->set('cthd',$tmp);
        //xử lí trả về dữ liệu hiển thị

         //$session->start();
         $cthds= $session->get('cthd');      
       return $this->render('hoadon/tablecthd.html.twig', array(
             'cthds'=>$cthds
       ));
       //return new Response();
        //còm xử lí delete với nếu như chọn sản phẩm trùng nhau.
    }
    /**
     * 
     *
     * @Route("/new", name="bill_new")
     * 
     */
    public function newAction(Request $request)
    {
        if($request->getMethod()== 'GET')
        {
        $session = new Session();
        $session->set('cthd',null);
        }
        $em = $this->getDoctrine()->getManager();
        $sanphams = $em->getRepository('AppBundle:SanPham')->findAll();
        $khachhang = new KhachHang();
        $form = $this->createForm('AppBundle\Form\KhachHangType', $khachhang);
        $form->handleRequest($request);
        //xử lí khi submit fomr khách hàng và tạo bill
        if ($form->isSubmitted() && $form->isValid()) {
            $session = new Session();
            if(count($session->get('cthd'))!= 0)
            {
                $em = $this->getDoctrine()->getManager();
                $em->persist($khachhang);   
                //khởi tạo hóa đơn
                $hoadon= new HoaDon();
                    $hoadon->setKH($khachhang);
                    $hoadon->setNgaydat(new \DateTime());
                    $hoadon->setNgaygiao(new \DateTime());
                    $hoadon->setTongtien(0);
                    $hoadon->setTrangthai('Đã giao');
                $em->persist($hoadon);
                $cthds = $session->get('cthd');
                $sum= 0;
                foreach ($cthds as $cthd) {
                    //Thêm cthd
                    $ct= new ChiTietHD();
                    $sanpham = $em->getRepository('AppBundle:SanPham')->findOneById($cthd->getSP()->getId('id'));
                     $ct->setHD($hoadon);
                     $ct->setSP($sanpham);
                     $ct->setTensp($sanpham->getTensp());
                     $ct->setSl($cthd->getSl('sl'));
                     $ct->setDongia($sanpham->getGia());
                     $ct->setThanhtien($cthd->getSl('sl')*$sanpham->getGia());
                     $em->persist($ct);
                     $sum += $ct->getThanhtien();
                }
                $hoadon->setTongtien($sum);
                $em->flush();            
                $session->clear();
                //trả về hóa đơn show
                return $this->redirectToRoute('bill_show', array('id' => $hoadon->getId()));  
            }
              
        }

        return $this->render('hoadon/new.html.twig', array(
            'sanphams'=>$sanphams,
            'khachhang'=>$khachhang,
            'form' => $form->createView(),
        ));
    }
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
    /**
     * Find Print a hoaDon entity.
     *
     * @Route("/print/{id}", name="bill_print")
     * @Method("GET")
     */
    public function PrintAction(HoaDon $hoadon)
    {

        $snappy =$this->get("knp_snappy.pdf");
        $snappy->setOption("encoding", "UTF-8");

        $html= $this->renderView('hoadon/print.html.twig',array('hoadon'=>$hoadon));

        $filename='abc';
        return new Response(
            $snappy->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'=> 'application/pdf',
                'Content-Disposition'=> 'inline; filename="'.$filename.'.pdf"'
            )
        );
    }
    /**
     * Deletes a hoadon entity.
     *
     * @Route("/delete/{id}", name="bill_delete", options={"expose"=true})
     * @Method({"DELETE","GET"})
     * @param HoaDon $id
     * @return Response
     */
    public function deleteAction(HoaDon $id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        foreach ($id->cthds as $cthd) {
            $em->remove($cthd);
        }
        $em->remove($id);
        $em->flush();
        if($request->getMethod()=="GET")
        {
            return $this->redirect($this->generateUrl("bill_index"));
        }
        return new Response();   
    }


}
