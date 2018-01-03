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
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->findAll();

        $username = $request->request->get('username');    
        $token =$this->get('lexik_jwt_authentication.encoder')->encode(['username'=> '1234']);

        $s = $this->get('lexik_jwt_authentication.encoder')->decode($token);
        return new JsonResponse(['token'=>$username]);
    }

}
