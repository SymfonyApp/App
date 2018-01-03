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
     * Lists all user entities.
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

}
