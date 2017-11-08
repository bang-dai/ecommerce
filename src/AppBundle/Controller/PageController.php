<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Page;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/page")
 * Class PageController
 * @package AppBundle\Controller
 */
class PageController extends Controller
{
    /**
     * @Route("/{id}", name="page.show", requirements={"id" = "\d+"})
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $page = $em->getRepository(Page::class)->find($id);
        if (!$page) {
            throw $this->createNotFoundException('Page not found');
        }

        return $this->render(':page:show.html.twig', ['page' => $page]);
    }

    public function menuAction()
    {
        $em = $this->getDoctrine()->getManager();
        $pages = $em->getRepository(Page::class)->findAll();

        return $this->render(':page:menu.html.twig', ['pages' => $pages]);
    }
}
