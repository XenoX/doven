<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Class SecurityController
 *
 * @package App\Controller
 */
class SecurityController extends Controller
{
    /**
     * @Route("/login")
     * @Method({"GET"})
     * @Template()
     */
    public function loginAction()
    {
        $authenticationUtils = $this->get('security.authentication_utils');
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return ['last_username' => $lastUsername, 'error' => $error];
    }

    /**
     * @Method({"POST"})
     * @Route("/login_check")
     */
    public function loginCheckAction()
    {
        throw new \RuntimeException(
            'You must configure the check path to be handled by the firewall
            using form_login in your security firewall configuration'
        );
    }

    /**
     * @Method({"GET"})
     * @Route("/logout")
     */
    public function logoutAction()
    {
        throw new \RuntimeException('You must activate the logout in your security firewall configuration');
    }
}
