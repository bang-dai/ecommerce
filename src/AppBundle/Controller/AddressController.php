<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Address;
use AppBundle\Form\AddressType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/address")
 * Class AddressController
 * @package AppBundle\Controller
 */
class AddressController extends Controller
{

    /**
     * @Route("/add", name="address.add")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addAction(Request $request)
    {
        $address = new Address();
        $form = $this->createForm(AddressType::class, $address);
        $form->handleRequest($request);
        $user = $this->getUser();
        if ($user && $form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $address->setUser($user);
            $em->persist($address);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('cart.delivery'));
    }

    /**
     * @Route("/delete/{id}", name="address.delete", requirements={"id" = "\d+"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request, Address $address)
    {
        if (!$address || $this->getUser() != $address->getUser()) {
            return $this->redirect($this->generateUrl('cart.delivery'));
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($address);
        $em->flush();

        return $this->redirect($this->generateUrl('cart.delivery'));
    }
}
