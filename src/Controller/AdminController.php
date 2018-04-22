<?php

namespace App\Controller;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class AdminController
 * @Route("/admin")
 * @package App\Controller
 */
class AdminController extends BaseAdminController
{
    /**
     * @Route("/dashboard")
     * @Template("admin/dashboard.html.twig")
     */
    public function dashboardAction()
    {
        return [];
    }
}
