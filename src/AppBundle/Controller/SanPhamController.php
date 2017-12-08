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
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Sanpham controller.
 *
 * @Route("sanpham")
 */
class SanPhamController extends Controller
{
/**
     * Creates a new user entity.
     *
     * @Route("/new", name="sanpham_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $sanpham = new SanPham();
        $loai= new LoaiSP();
        $_select= new LoaiSP();
        
         $em = $this->getDoctrine()->getManager();
        $_select= $em->getRepository('AppBundle:LoaiSP')->findAll();
        if ($request->getMethod()=="POST")
         {
            
             $sanpham->setTensp($request->request->get('_tensp'));
             $sanpham->setGia($request->request->getInt('_gia'));
             $sanpham->setMota($request->request->get('_mota'));
             //loaisp
             $loai = $this->getDoctrine()
             ->getRepository(LoaiSP::class)
             ->findOneById($request->request->getInt('_loaisp'));
             $sanpham->setLoaiSP($loai);
             $em->persist($sanpham);
             $em->flush();
            //image
            /** @var UploadedFile|null $file */
            $list = $request->files->get('_upload');
            
            foreach ($list as $img) {
              $filename=md5(uniqid()).'.'.$img->guessExtension();
              $img->move($this->container->getParameter('images_directory'),$filename);
               print_r($filename);
              $image= new Images();
              $image->setTenhinh($filename);    
              $image->setSanpham($sanpham);
              $em->persist($image);
              $em->flush();
            }

             return $this->render('sanpham/new.html.twig',array('_select' =>$_select, ));
         }
        return $this->render('sanpham/new.html.twig', array(
            '_select'=>$_select,
        ));

      //  return $this->render('sanpham/new.html.twig');
    }
}
