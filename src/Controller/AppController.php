<?php

namespace App\Controller;

use App\Entity\Carousel;
use App\Entity\News;
use App\Entity\Partner;
use App\Entity\Stream;
use App\Entity\Team;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Twig\Loader\LoaderInterface;

/**
 * Class AppController
 *
 * @package App\Controller
 */
class AppController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction(LoaderInterface $loader)
    {
        $carousels = $this->getDoctrine()->getRepository(Carousel::class)->findBy(['enabled' => true]);
        $news = $this->getDoctrine()->getRepository(News::class)->findBy(['enabled' => true], ['id' => 'DESC'], 5);
        $partners = $this->getDoctrine()->getRepository(Partner::class)->findBy(['enabled' => true]);
        $streams = $this->getDoctrine()->getRepository(Stream::class)->findBy(['enabled' => true]);
        $teams = $this->getDoctrine()->getRepository(Team::class)->findBy(['enabled' => true]);

        $params = [
            'carousels' => $carousels,
            'news' => $news,
            'partners' => $partners,
            'streams' => $streams,
            'teams' => $teams
        ];

        if ($loader->exists($this->getParameter('theme.dir').'index.html.twig')) {
            return $this->render($this->getParameter('theme.dir').'index.html.twig', $params);
        }

        return $this->render('index/'.$this->getParameter('theme.index').'.html.twig', $params);
    }

    /**
     * @Route("/contact")
     */
    public function contactAction(LoaderInterface $loader)
    {
        if (false === $this->getParameter('access.contact') || true === $this->getParameter('theme.onepage')) {
            return $this->redirectToRoute('app_app_index');
        }

        if ($loader->exists($this->getParameter('theme.dir').'contact.html.twig')) {
            return $this->render($this->getParameter('theme.dir').'contact.html.twig');
        }

        return $this->render('app/contact.html.twig');
    }

    /**
     * @Route("/news")
     */
    public function newsAction(LoaderInterface $loader)
    {
        if (false === $this->getParameter('access.news') || true === $this->getParameter('theme.onepage')) {
            return $this->redirectToRoute('app_app_index');
        }

        if ($loader->exists($this->getParameter('theme.dir').'news.html.twig')) {
            return $this->render($this->getParameter('theme.dir').'news.html.twig');
        }

        return $this->render('app/news.html.twig');
    }

    /**
     * @Route("/partner")
     */
    public function partnerAction(LoaderInterface $loader)
    {
        if (false === $this->getParameter('access.partner') || true === $this->getParameter('theme.onepage')) {
            return $this->redirectToRoute('app_app_index');
        }

        if ($loader->exists($this->getParameter('theme.dir').'partner.html.twig')) {
            return $this->render($this->getParameter('theme.dir').'partner.html.twig');
        }

        return $this->render('app/partner.html.twig');
    }

    /**
     * @Route("/stream")
     */
    public function streamAction(LoaderInterface $loader)
    {
        if (false === $this->getParameter('access.stream') || true === $this->getParameter('theme.onepage')) {
            return $this->redirectToRoute('app_app_index');
        }

        if ($loader->exists($this->getParameter('theme.dir').'stream.html.twig')) {
            return $this->render($this->getParameter('theme.dir').'stream.html.twig');
        }

        return $this->render('app/stream.html.twig');
    }

    /**
     * @Route("/team")
     */
    public function teamAction(LoaderInterface $loader)
    {
        if (false === $this->getParameter('access.team') || true === $this->getParameter('theme.onepage')) {
            return $this->redirectToRoute('app_app_index');
        }

        if ($loader->exists($this->getParameter('theme.dir').'team.html.twig')) {
            return $this->render($this->getParameter('theme.dir').'team.html.twig');
        }

        return $this->render('app/team.html.twig');
    }
}
