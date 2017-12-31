<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\View\View;
use AppBundle\Entity\User;
/**
 * User api controller.
 *
 * @Route("api")
 */
class ApiUserController extends FOSRestController
{
    /**
     * @Rest\Get("/user")
     */
    public function getAction()
    {
      $restresult = $this->getDoctrine()->getRepository('AppBundle:User')->findAll();
        if ($restresult === null) {
          return new View("there are no users exist", Response::HTTP_NOT_FOUND);
        }
        $serializer = $this->get('jms_serializer');
        $response = [
            'msg' => 'List of all user',
            'users' => $restresult
        ];
        $listuser = $serializer->serialize($response, 'json');
        return new Response($listuser, 200);
    }
    /**
    * @Rest\Get("/user/{id}")
    */
    public function showAction($id)
    {
       $singleresult = $this->getDoctrine()->getRepository('AppBundle:User')->find($id);
       if ($singleresult === null) {
       return new View("user not found", Response::HTTP_NOT_FOUND);
       }
        $serializer = $this->get('jms_serializer');
        $response = [
            'msg' => 'User infomation',
            'user' => $singleresult
        ];
        $user = $serializer->serialize($response, 'json');
        return new Response($user, 200);
    }
    /**
    * @Rest\Post("/user/create")
    */
    public function createAction(Request $request)
    {

        $username= $request->get('username');
        $password= $request->get('password');
        $email= $request->get('email');
        $role= $request->get('role');
        if(empty($username)||empty($password)|| empty($email)|| empty($role))
        {
            return new View("user creation failed", Response::HTTP_FAILED_DEPENDENCY);
        }
        $em = $this->getDoctrine()->getManager();

        $user = new User();
            $user->setUsername($username);
            $user->setRole($role);
            $user->setEmail($email);
            $encoder = $this->container->get('security.password_encoder');
            $encoded = $encoder->encodePassword($user,$user->getPassword());
            $user->setPassword($encoded);
            $em->persist($user);
            $em->flush();

        $serializer = $this->get('jms_serializer');
        $response = [
            'msg' => 'User infomation',
            'user' => $user
        ];
        $user = $serializer->serialize($response, 'json');
        return new Response($user, Response::HTTP_CREATED);
    }
    /**
    * @Rest\PUT("/user/update/{id}")
    */
    public function updateAction(Request $request, $id)
    {
        $user = $this->getDoctrine()->getRepository('AppBundle:User')->find($id);
        if ($user === null) {
          return new View("user not found", Response::HTTP_NOT_FOUND);
        }
        $username= $request->get('username');
        $password= $request->get('password');
        $email= $request->get('email');
        $role= $request->get('role');
        if(empty($username)||empty($password)|| empty($email)|| empty($role))
        {
            return new View("user update failed", Response::HTTP_FAILED_DEPENDENCY);
        }
        $em = $this->getDoctrine()->getManager();

            $user->setUsername($username);
            $user->setRole($role);
            $user->setEmail($email);
            $encoder = $this->container->get('security.password_encoder');
            $encoded = $encoder->encodePassword($user,$user->getPassword());
            $user->setPassword($encoded);
            $em->flush();

        $serializer = $this->get('jms_serializer');
        $response = [
            'msg' => 'User infomation',
            'user' => $user
        ];
        $user = $serializer->serialize($response, 'json');
        return new Response($user, Response::HTTP_ACCEPTED);
    }
    /**
    * @Rest\Delete("/user/delete/{id}")
    */
    public function deletAction($id)
    {
       $singleresult = $this->getDoctrine()->getRepository('AppBundle:User')->find($id);
       if ($singleresult === null) {
       return new View("user not found", Response::HTTP_NOT_FOUND);
       }
        $em = $this->getDoctrine()->getManager();
        $em->remove($singleresult);
        $em->flush();
        return new View("deleted user", 200);
    }
}
