<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Post;

class DefaultController extends AbstractController
{
    /**
     * @author Poprugailo Denis <d.poprugailo@piogroup.net>
     * @Route("/", name="default_index")
     * @return Response
     */
    public function index(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository(Post::class)->findAll();

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

