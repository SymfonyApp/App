<?php

namespace AppBundle\Controller;

use AppBundle\Entity\SanPham;
use AppBundle\Entity\LoaiSP;
use AppBundle\Entity\Images;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\FileBag;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Sanpham controller.
 *
 * @Route("sanpham")
 */
class SanPhamController extends Controller
{
  /**
   * Creates a new product entity.
   *
   * @Route("/new", name="product_new")
   * @Method({"GET", "POST"})
   */
  public function newAction(Request $request)
  {
    $sanpham = new SanPham();
    $loai= new LoaiSP();
    $_select= new LoaiSP();
    $errors=null;
    $em = $this->getDoctrine()->getManager();
    $_select= $em->getRepository('AppBundle:LoaiSP')->findAll();
      if ($request->getMethod()=="POST")
      {
         $sanpham->setTensp($request->request->get('_tensp'));
         $sanpham->setGia($request->request->getInt('_gia'));
         $sanpham->setMota($request->request->get('_mota'));
         //validation
         $validator = $this->get('validator');
         $errors = $validator->validate($sanpham);
          if (count($errors) > 0)
          {
            //  print_r($errors);
              return $this->render('sanpham/new.html.twig', array('_select'=>$_select,
                    'errors'=>$errors,));
          }
          else {
            //loaisp
             $loai = $this->getDoctrine()
             ->getRepository(LoaiSP::class)
             ->findOneById($request->request->getInt('_loaisp'));
             $sanpham->setLoaiSP($loai);
             $em->persist($sanpham);
             $em->flush();
              //image
              /** @var UploadedFile|null $file */
             $listfile = $request->files->get('_upload');
              foreach ($listfile as $img) {
                $filename=md5(uniqid()).'.'.$img->guessExtension();
                $img->move($this->container->getParameter('images_directory'),$filename);
                 //print_r($filename);
                $image= new Images();
                $image->setTenhinh($filename);    
                $image->setSanpham($sanpham);
                $em->persist($image);
                $em->flush();
              }
              return $this->redirectToRoute('product_show', array('id' => $sanpham->getId()));
          }
          
       }
      return $this->render('sanpham/new.html.twig', array(
          '_select'=>$_select,
          'errors'=>$errors,
      ));
  }   
  /** 
   * List product entity
   * @Route("/", name="product_index")
   * 
   */
  public function indexAction(Request $request)
  {
    $em= $this->getDoctrine()->getManager();
    if($request->query->getAlnum('_search'))
    {
      $sanpham=$em->getRepository('AppBundle:SanPham')->findProductByString($request->query->getAlnum('_search'));
    }
    else
    {
      $sanpham= $em->getRepository('AppBundle:SanPham')->findAll();
    }
    /**
     * 
     * @var $paginator \Knp\Component\Pager\Paginator
     */
    $paginator  = $this->get('knp_paginator');
    $sanphams = $paginator->paginate(
        $sanpham,
        $request->query->getInt('page',1),
        $request->query->getInt('limit',10)
    );
    return $this->render('sanpham/index.html.twig', array(
          'sanphams'=>$sanphams));
  }
 /**
   * Finds and displays a SanPham entity.
   *
   * @Route("/{id}", name="product_show")
   * @Method("GET")
   */
  public function showAction(SanPham $sanpham)
  {
      return $this->render('sanpham/show.html.twig', array(
          'sanpham' => $sanpham,
      ));
  }
 /**
   * Displays a form to edit an existing SanPham entity.
   *
   * @Route("/{id}/edit", name="product_edit")
   * @Method({"GET", "POST"})
   */
  public function editAction(Request $request, SanPham $sanpham)
  {
    $_select= new LoaiSP();
    $em = $this->getDoctrine()->getManager();
    $_select= $em->getRepository('AppBundle:LoaiSP')->findAll();
    $errors=null;
    if($request->getMethod()=='POST')
    {
      $sanpham->setTensp($request->request->get('_tensp'));
      $sanpham->setGia($request->request->getInt('_gia'));
      $sanpham->setMota($request->request->get('_mota'));
      //validation
         $validator = $this->get('validator');
         $errors = $validator->validate($sanpham);
          if (count($errors) > 0)
          {
            //  print_r($errors);
              return $this->render('sanpham/edit.html.twig', array('sanpham'=>$sanpham,
                      '_select'=>$_select,
                      'errors'=>$errors));
          }
          else
          {
            $loai= new LoaiSP();
            $loai = $this->getDoctrine()
             ->getRepository(LoaiSP::class)
             ->findOneById($request->request->getInt('_loaisp'));
             $sanpham->setLoaiSP($loai);  
             $em->flush();
             //image
              /** @var UploadedFile|null $file */
             $listfile = $request->files->get('_upload');
             if(count($listfile) != 0)
             {
                foreach ($listfile as $img) {
                $filename=md5(uniqid()).'.'.$img->guessExtension();
                $img->move($this->container->getParameter('images_directory'),$filename);
                 //print_r($filename);
                $image= new Images();
                $image->setTenhinh($filename);    
                $image->setSanpham($sanpham);
                $em->persist($image);
                $em->flush();
              }
             }
              
          }
    }
        return $this->render('sanpham/edit.html.twig', array(
        'sanpham'=>$sanpham,
        '_select'=>$_select,
        'errors'=>$errors
    ));
  }

   /**
   *
   * @Route("/delete/img", name="image_delete")
   * @Method({"GET", "POST"})
   */
  public function deleteimageAction(Request $request)
  {

        $em = $this->getDoctrine()->getManager();
         $img = $em->getRepository('AppBundle:Images')->findOneById($request->request->get('_id'));    
        $em->remove($img);
        $em->flush();
        $sanpham= $em->getRepository('AppBundle:SanPham')->findOneById($request->request->get('idsp'));
        //return new Response();
        return $this->render('sanpham/tableimg.html.twig', array(
             'sanpham' => $sanpham,
         ));
  }
  /**
   * Deletes a SanPham entity.
   *
   * @Route("/delete/{id}", name="product_delete", options={"expose"=true})
   * @Method({"DELETE","GET"})
   * @param SanPham $id
   * @return Response
   */
  public function deleteAction(SanPham $id, Request $request)
  {
      $em = $this->getDoctrine()->getManager();

      foreach ($id->images as $img ) {
        //remove image
        $em->remove($img);
        $em->flush();
      }
      foreach ($id->getCthds() as $cthd) {
        $id->removeCTHD($cthd);     
      }
      $em->remove($id);
      
      $em->flush();
      if($request->getMethod()=="GET")
      {
          return $this->redirect($this->generateUrl("product_index"));
      }
      return new Response();   
  }
  
}
