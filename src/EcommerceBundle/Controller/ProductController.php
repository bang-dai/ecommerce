<?php

namespace EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/product")
 * Class ProductController
 * @package EcommerceBundle\Controller
 */
class ProductController extends Controller
{
    /**
     * @Route("/", name="product.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('EcommerceBundle:Product:index.html.twig');
    }


    /**
     * @Route("/{id}", name="product.show", requirements={"id" = "\d+"}, defaults={ "id" = 1})
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction($id)
    {
        return $this->render('EcommerceBundle:Product:show.html.twig');
    }
}
