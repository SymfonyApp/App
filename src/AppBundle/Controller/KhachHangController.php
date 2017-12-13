<?php

namespace AppBundle\Controller;

use AppBundle\Entity\KhachHang;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Khachhang controller.
 *
 * @Route("khachhang")
 */
class KhachHangController extends Controller
{
    /**
     * 
     *
     * @Route("/new", name="customer_new")
     * 
     */
    public function newAction(Request $request)
    {
        $khachhang = new KhachHang();
        $form = $this->createForm('AppBundle\Form\KhachHangType', $khachhang);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($khachhang);
            $em->flush();

            return $this->redirectToRoute('customer_show', array('id' => $khachhang->getId()));
        }

        return $this->render('khachhang/new.html.twig', array(
            'khachhang' => $khachhang,
            'form' => $form->createView(),
        ));
    }
    /**
     * Lists all khachHang entities.
     *
     * @Route("/", name="customer_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $khachhang = $em->getRepository('AppBundle:KhachHang')->findAll();
        /**
         * 
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator  = $this->get('knp_paginator');
        $khachhangs = $paginator->paginate(
            $khachhang,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',10)
        );
        return $this->render('khachhang/index.html.twig', array(
            'khachhangs' => $khachhangs,
        ));
    }

    /**
     * Finds and displays a khachHang entity.
     *
     * @Route("/{id}", name="customer_show")
     * @Method("GET")
     */
    public function showAction(KhachHang $khachhang)
    {

        return $this->render('khachhang/show.html.twig', array(
            'khachhang' => $khachhang,
        ));
    }
    /**
     *
     * @Route("/{id}/edit", name="customer_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, KhachHang $khachhang)
    {
        $editForm = $this->createForm('AppBundle\Form\KhachHangType', $khachhang);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('customer_edit', array('id' => $khachhang->getId()));
        }

        return $this->render('khachhang/edit.html.twig', array(
            'khachhang' => $khachhang,
            'edit_form' => $editForm->createView(),
        ));
    }
    /**
     * Deletes a khachhang entity.
     *
     * @Route("/delete/{id}", name="customer_delete", options={"expose"=true})
     * @Method({"DELETE","GET"})
     * @param KhachHang $id
     * @return Response
     */
    public function deleteAction(KhachHang $id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        foreach ($id->gethds() as $hdkh) {
            //customer_id set null
            $id->removeHD($hdkh);
        }
        $em->remove($id);
        $em->flush();   
        if($request->getMethod()=="GET")
        {
            return $this->redirect($this->generateUrl("customer_index"));
        }
        return new Response();   
    }

}
