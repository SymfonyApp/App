<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Entity\User;

class LoginController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request, AuthenticationUtils $authUtils)
    {
        // get the login error if there is one
        $error = $authUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authUtils->getLastUsername();
        return $this->render('default/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }

    /**
     * @Route("/logout", name ="logout")
     */
    public function logoutAction()
    {
        return null;
    }
    /**
     * @Route("/forgot", name ="forgot")
     */
    public function forgotAction(Request $request)
    {
        $user = $this->getDocTrine()->getRepository(User::class)->findOneByUsername($request->request->get('_username'));
        if($user !=null && $user->getEmail()==$request->request->get('_email'))
        {
            $pass=rand(10000,99999);
            $encoder = $this->container->get('security.password_encoder');
            $encoded = $encoder->encodePassword($user,$pass);
            $user->setPassword($encoded);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            
                $message =\Swift_Message::newInstance()
                ->setSubject('Forgot Password Symfony')
                ->setFrom('appsymfony@gmail.com')
                ->setTo($user->getEmail())
                ->setBody('Mật khẩu mới của bạn là: '.$pass);
                $this->get('mailer')->send($message);
                        
            return $this->redirect('/login');
        }
        return $this->render('default/forgot.html.twig', array(
        ));
    }

}
