<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/page")
 * Class CartController
 * @package AppBundle\Controller
 */
class CmsController extends Controller
{
    /**
     * @Route("/{id}", name="cms.show")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($id)
    {
        return $this->render(':cms:show.html.twig');
    }
}
