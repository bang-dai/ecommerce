<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use AppBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/category")
 * Class CategoryController
 * @package AppBundle\Controller
 */
class CategoryController extends Controller
{


    public function menuAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository(Category::class)->findAll();

        return $this->render(':category:menu.html.twig', ['categories' => $categories]);
    }


    /**
     * @Route("/{id}", name="category.products", requirements={"id" = "\d+"})
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function categoryProductsAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository(Product::class)->byCategory($id);
        if (!$products) {
            throw $this->createNotFoundException('Products not found');
        }

        return $this->render(':product:index.html.twig', ['products' => $products]);
    }
}
