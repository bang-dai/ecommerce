<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/product")
 * Class ProductController
 * @package AppBundle\Controller
 */
class ProductController extends Controller
{
    /**
     * @Route("/{id}", name="product.show", requirements={"id" = "\d+"})
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository(Product::class)->find($id);
        if (!$product) {
            throw $this->createNotFoundException('Product not found');
        }

        return $this->render(':product:show.html.twig', ['product' => $product]);
    }
}
