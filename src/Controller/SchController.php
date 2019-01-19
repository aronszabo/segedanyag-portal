<?php
namespace App\Controller;


use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
class SchController extends AbstractController
{
    /**
     * Link to this controller to start the "connect" process
     *
     * @Route("/connect/sch", name="connect_sch")
     * @param ClientRegistry $clientRegistry
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function connectAction(ClientRegistry $clientRegistry)
    {
        return $clientRegistry
            ->getClient('sch')
            ->redirect();
    }

    /**
     * Sch redirects to back here afterwards
     *
     * @Route("/connect/sch/check", name="connect_sch_check")
     * @param Request $request
     * @return JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function connectCheckAction(Request $request)
    {
        if (!$this->getUser()) {
            return new JsonResponse(array('status' => false, 'message' => "User not found!"));
        } else {
          $key = '_security.main.target_path';

          // try to redirect to the last page, or fallback to the homepage
          if ($this->container->get('session')->has($key)) {
            $url = $this->container->get('session')->get($key);
            $this->container->get('session')->remove($key);
          } else {
            $url = $this->container->get('router')->generate('default');
          }

          return new RedirectResponse($url);
            //return $this->redirectToRoute('default');
        }

    }
    /**
     * Log in
     *
     * @Route("/login", name="login")
     * @param Request $request
     * @return JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function loginAction(Request $request)
    {
        return $this->redirectToRoute('connect_sch');
    }
}
