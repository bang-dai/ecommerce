<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Address;
use AppBundle\Entity\Product;
use AppBundle\Form\AddressType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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
    public function indexAction(Request $request)
    {
        return $this->getCartItems($request, ':cart:index.html.twig');
    }


    /**
     * @Route("/delivery", name="cart.delivery")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deliveryAction(Request $request)
    {
        $form = $this->createForm(AddressType::class, new Address());

        return $this->render(':cart:delivery.html.twig', [
            'form' => $form->createView(),
            'user' => $this->getUser()
        ]);
    }

    /**
     * @Route("/confirm", name="cart.confirm")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function confirmAction()
    {
        return $this->render(':cart:confirm.html.twig');
    }

    /**
     * @Route("/add/{id}", name="cart.add", requirements={"id" = "\d+"})
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addAction(Request $request, $id)
    {
        $session = $request->getSession();
        if (!$session->has('cart')) {
            $session->set('cart', array());
        }
        $cart = $session->get('cart');
        $qte = $request->get('qte') ? $request->get('qte') : 1;
        //$cart[$id] = array_key_exists($id, $cart) ? $cart[$id] + (int)$qte : (int)$qte;
        $cart[$id] = array_key_exists($id, $cart) ? (int) $qte : (int) $qte;
        $session->set('cart', $cart);
        $this->addFlash('success', 'Article ajouté avec succès');

        return $this->redirect($this->generateUrl('cart.index'));
    }


    /**
     * @Route("/delete/{id}", name="cart.delete", requirements={"id" = "\d+"})
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request, $id)
    {
        $session = $request->getSession();
        $cart = $session->get('cart');
        if (array_key_exists($id, $cart)) {
            unset($cart[$id]);
            $session->set('cart', $cart);
            $this->addFlash('success', 'Article supprimé avec succès');
        }

        return $this->redirect($this->generateUrl('cart.index'));
    }

    public function menuAction(Request $request)
    {
        return $this->getCartItems($request, ':cart:menu.html.twig');
    }

    protected function getCartItems(Request $request, string $template)
    {
        $session = $request->getSession();
        if (!$session->has('cart')) {
            $session->set('cart', array());
        }
        $cart = $session->get('cart');
        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository(Product::class)->findById(array_keys($cart));

        return $this->render($template, ['products' => $products, 'cart' => $cart]);
    }
}
