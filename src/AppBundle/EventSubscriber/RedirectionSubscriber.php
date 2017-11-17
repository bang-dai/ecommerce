<?php
namespace AppBundle\EventSubscriber;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class RedirectionSubscriber implements EventSubscriberInterface, ContainerAwareInterface
{
    use ContainerAwareTrait;
    protected $session;
    protected $router;
    protected $tokenStorage;
    protected $authChecker;

    public function __construct(ContainerInterface $container, SessionInterface $session)
    {
        $this->session = $session;
        $this->router = $container->get('router');
        $this->tokenStorage = $container->get('security.token_storage');
        $this->authChecker = $container->get('security.authorization_checker');
        $this->setContainer($container);
    }


    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::REQUEST => array(
                array('onKernelRequest', 0)
            )
        );
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $route = $event->getRequest()->attributes->get('_route');
        if ($route == 'cart.delivery' || $route == 'cart.confirm') {
            if ($this->session->has('cart') && count($this->session->get('cart')) == 0) {
                $event->setResponse(new RedirectResponse($this->router->generate('cart.index')));
            }
            if (!$this->authChecker->isGranted('ROLE_USER')) {
                $this->session->getFlashBag()->add('warning', 'Vous devez vous identifier');
                $event->setResponse(new RedirectResponse($this->router->generate('fos_user_security_login')));
            }
        }
    }
}
