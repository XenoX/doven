<?php

namespace App\Controller;

use App\Entity\User;
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

    /**
     * {@inheritdoc}
     */
    public function updateEntity($entity)
    {
        if (method_exists($entity, 'setUpdatedAt')) {
            $entity->setUpdatedAt(new \DateTime());
        }

        parent::updateEntity($entity);
    }

    /**
     * {@inheritdoc}
     */
    public function updateUserEntity(User $user)
    {
        if ($user->getPlainPassword()) {
            $passwordEncoder = $this->get('security.password_encoder');
            $user->setPassword($passwordEncoder->encodePassword($user, $user->getPlainPassword()));
        }

        parent::updateEntity($user);
    }

    /**
     * {@inheritdoc}
     */
    public function prePersistUserEntity(User $user)
    {
        if ($user->getPlainPassword()) {
            $passwordEncoder = $this->get('security.password_encoder');
            $user->setPassword($passwordEncoder->encodePassword($user, $user->getPlainPassword()));
        }

        parent::prePersistEntity($user);
    }

    /**
     * {@inheritdoc}
     */
    public function removeEntity($entity)
    {
        if ($this->isGranted('ROLE_ADMIN')) {
            parent::removeEntity($entity);

            return;
        }

        $this->addFlash('danger', $this->get('translator')->trans('flash.danger.no_access'));
    }
}
