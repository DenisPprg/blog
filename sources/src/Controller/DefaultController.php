<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\User;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Class DefaultController
 * @package App\Controller
 *
 * @author Denis
 */

class DefaultController extends AbstractController
{
    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function defaultLocale()
    {
        // REFERER
        return $this->redirectToRoute('default_index');
    }

    /**
     * @author Poprugailo Denis <d.poprugailo@piogroup.net>
     * @Route("/", name="default_index")
     * @param  PostRepository $postRepository;
     * @return Response
     */
    public function index(PostRepository $postRepository): Response
    {
        /*$em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository(Post::class)->findAll();*/
        $posts = $postRepository->findAll();
        $posts = array_reverse($posts);

        return $this->render('default/default.html.twig', [
            'posts' => $posts,
        ]);
    }

    /**
     * @author Poprugailo Denis <d.poprugailo@piogroup.net>
     * @Route("/about", name="default_about")
     * @return Response
     */
    public function about()
    {
        return $this->render('default/about.html.twig');
    }

    /**
     * @author Poprugailo Denis <d.poprugailo@piogroup.net>
     * @Route("/feedback", name="default_feedback")
     * @return Response
     */
    public function feedback()
    {
        return $this->render('default/feedback.html.twig');
    }
}

