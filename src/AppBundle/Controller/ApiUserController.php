<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ParameterBag;
/**
 * User controller.
 *
 * @Route("api")
 */
class ApiUserController extends Controller
{

    /**
     *
     * @Route("/login", name="user_login")
     * @Method("POST")
     */
    public function loginAction(Request $request)
    {
        
        if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
            $data = json_decode($request->getContent(), true);
            $request->request->replace(is_array($data) ? $data : array());
        }
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->findOneBy(['username'=>$data['username']]);
        if(!$user)
        {
            throw $this->creteNotFountExeption();            
        }
        $factory = $this->get('security.encoder_factory');
        $encoder = $factory->getEncoder($user);
        if($encoder->isPasswordValid($user->getPassword(),$data['password'],$user->getSalt()))
        {
            $token =$this->get('lexik_jwt_authentication.encoder')->encode(['data'=> $data]);
            //$s = $this->get('lexik_jwt_authentication.encoder')->decode($token);
            return new JsonResponse(['token'=>$token]);        
        }
        return new JsonResponse(['message'=>'Incorrect password'], Response::HTTP_FAILED_DEPENDENCY);
    }
    /**
     * @Route("/user", name ="api_user_index") 
     * 
     */
    public function indexAction()
    {
        $em= $this->getDoctrine()->getManager();
        $users =$em->getRepository('AppBundle:User')->findAll();

        $serializer = $this->get('jms_serializer');
        $listuser = $serializer->serialize($users, 'json');
       // return new Response(json_encode($listuser), 200);
       return new JsonResponse(json_decode($listuser),200);
    }
    /**
     * @Route("/user/{id}", name="api_user_show")
     * @Method("GET")
     */
    public function showAction($id)
    {
        $em= $this->getDoctrine()->getManager();
        $user =$em->getRepository('AppBundle:User')->findOneBy(['id'=>$id]);
        if($user === null)
        {
            return new JsonResponse('Count not find user with id = '.$id ,500);
        }
        $serializer = $this->get('jms_serializer');
        $usershow = $serializer->serialize($user, 'json');
        return new JsonResponse(json_decode($usershow), 200);
    }
    /**
     * @Route("/user/create", name="api_user_create")
     * @Method("POST")
     */
    public function createAction(Request $request)
    {
        $token =$request->get('token');
        $usertoken = $this->get('lexik_jwt_authentication.encoder')->decode($token);
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->findOneBy(['username'=>$usertoken['data']['username']]);
        if(!$user)
        {
            throw $this->creteNotFountExeption();            
        }
        $factory = $this->get('security.encoder_factory');
        $encoder = $factory->getEncoder($user);
        if($encoder->isPasswordValid($user->getPassword(),$usertoken['data']['password'],$user->getSalt()))
        {
            if (0 === strpos($request->headers->get('Content-Type'), 'application/json'))
            {
                $data = json_decode($request->getContent(), true);
                $request->request->replace(is_array($data) ? $data : array());
                $usernew= new User();
                    $usernew->setUsername($data['username']);
                    $usernew->setRole($data['role']);
                    $usernew->setEmail($data['email']);
                    $encoderpass = $this->container->get('security.password_encoder');
                    $encodedpass = $encoderpass->encodePassword($usernew,$data['password']);
                    $usernew->setPassword($encodedpass);
                    $em->persist($usernew);
                    $em->flush();
                $serializer = $this->get('jms_serializer');
                $usershow = $serializer->serialize($usernew, 'json');
                return new JsonResponse(json_decode($usershow), 200);
            }
        }
        return new JsonResponse(['message'=>'token fail'], Response::HTTP_FAILED_DEPENDENCY);

    }
    /**
     * @Route("/user/delete/{id}", name="api_user_show")
     * @Method("DELETE")
     */
    public function deleteAction($id, Request $request)
    {
        $token =$request->get('token');
        $usertoken = $this->get('lexik_jwt_authentication.encoder')->decode($token);
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->findOneBy(['username'=>$usertoken['data']['username']]);
        if(!$user)
        {
            throw $this->creteNotFountExeption();            
        }
        $factory = $this->get('security.encoder_factory');
        $encoder = $factory->getEncoder($user);
        if($encoder->isPasswordValid($user->getPassword(),$usertoken['data']['password'],$user->getSalt()))
        {
            $user =$em->getRepository('AppBundle:User')->findOneBy(['id'=>$id]);
            if($user === null)
            {
                return new JsonResponse('Count not find user with id = '.$id ,500);
            }

            $em->remove($user);
            $em->flush();
            return new JsonResponse(['message'=>'deleted user'], 200);
            
        }
        return new JsonResponse(['message'=>'token fail'], Response::HTTP_FAILED_DEPENDENCY);

        
    }
}
