<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SearchBarController extends Controller
{
    /**
     * @Route("/search")
     */
    public function searchAction()
    {
        return $this->render('user/home.html.twig', array(
            // ...
        ));
    }

}
