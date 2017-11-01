<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cart")
 * Class CartController
 * @package AppBundle\Controller
 */
class CartController extends Controller
{
    /**
     * @Route("/", name="cart.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render(':cart:index.html.twig');
    }


    /**
     * @Route("/delivery", name="cart.delivery")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deliveryAction()
    {
        return $this->render(':cart:delivery.html.twig');
    }

    /**
     * @Route("/confirm", name="cart.confirm")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function confirmAction()
    {
        return $this->render(':cart:confirm.html.twig');
    }
}
