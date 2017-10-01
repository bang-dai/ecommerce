<?php

namespace EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cart")
 * Class CartController
 * @package EcommerceBundle\Controller
 */
class CartController extends Controller
{
    /**
     * @Route("/", name="cart.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('EcommerceBundle:Cart:index.html.twig');
    }


    /**
     * @Route("/delivery", name="cart.delivery")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deliveryAction()
    {
        return $this->render('EcommerceBundle:Cart:delivery.html.twig');
    }

    /**
     * @Route("/confirm", name="cart.confirm")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function confirmAction()
    {
        return $this->render('EcommerceBundle:Cart:confirm.html.twig');
    }
}
