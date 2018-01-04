<?php
namespace AppBundle\Controller;

use AppBundle\Entity\SanPham;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CartController extends Controller
{
    /**
     * @Route("/cart/add")
     */
     public function addAction($id)
    {
        // fetch the cart
        $em = $this->getDoctrine()->getEntityManager();
        $product = $em->getRepository('AppBundle:SanPham')->find($id);
        //print_r($product->getId()); die;
        $session = $this->getRequest()->getSession();
        $cart = $session->get('cart', array());


        // check if the $id already exists in it.
        if ( $product == NULL ) {
             $this->get('session')->setFlash('notice', 'This product is not available in Stores');
            return $this->redirect($this->generateUrl('cart'));
        } else {
            if( isset($cart[$id]) ) {

                $qtyAvailable = $product->getQuantity();

                if( $qtyAvailable >= $cart[$id]['quantity'] + 1 ) {
                    $cart[$id]['quantity'] = $cart[$id]['quantity'] + 1;
                } else {
                    $this->get('session')->setFlash('notice', 'Quantity     exceeds the available stock');
                    return $this->redirect($this->generateUrl('cart'));
                }
            } else {
                // if it doesnt make it 1
                $cart = $session->get('cart', array());
                $cart[$id] = $id;
                $cart[$id]['quantity'] = 1;
            }

            $session->set('cart', $cart);
            return $this->redirect($this->generateUrl('cart'));

        }
    }

    /**
     * @Route("/cart")
     */
     public function indexAction()
   {
       // get the cart from  the session
       $session = $this->getRequest()->getSession();
       // $cart = $session->set('cart', '');
       $cart = $session->get('cart', array());

       // $cart = array_keys($cart);
       // print_r($cart); die;

       // fetch the information using query and ids in the cart
       if( $cart != '' ) {
         $em = $this->getDoctrine()->getEntityManager();
         foreach( $cart as $id => $quantity ) {
               $product[] = $em->getRepository('WebmuchProductBundle:Product')->findById($id)
         }

         if( !isset( $product ) )
         {
             return $this->render('store/cart.html.twig', array(
                 'empty' => true,
             ));
         }
           return $this->render('store/cart.html.twig',     array(
               'product' => $product,
           ));
       } else {
           return $this->render('store/cart.html.twig',     array(
               'empty' => true,
           ));
       }
   }

    /**
     * @Route("/cart/remove/{$id}")
     */
     public function removeAction($id)
     {
         // check the cart
         $session = $this->getRequest()->getSession();
         $cart = $session->get('cart', array());

         // if it doesn't exist redirect to cart index page. end
         if(!$cart) { $this->redirect( $this->generateUrl('cart') ); }

         // check if the $id already exists in it.
         if( isset($cart[$id]) ) {
             // if it does ++ the quantity
             $cart[$id]['quantity'] = '0';
             unset($cart[$id]);
             //echo $cart[$id]['quantity']; die();
         } else {
             $this->get('session')->setFlash('notice', 'Go to hell');
             return $this->redirect( $this->generateUrl('cart') );
         }

         $session->set('cart', $cart);

         // redirect(index page)
         $this->get('session')->setFlash('notice', 'This product is Remove');
         return $this->redirect( $this->generateUrl('cart') );
     }

}
