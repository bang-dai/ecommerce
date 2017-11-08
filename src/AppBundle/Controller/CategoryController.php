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
        if (!$em->getRepository(Category::class)->find($id)) {
            throw $this->createNotFoundException('Category not found');
        }
        $products = $em->getRepository(Product::class)->byCategory($id);
        
        return $this->render(':product:index.html.twig', ['products' => $products]);
    }
}
