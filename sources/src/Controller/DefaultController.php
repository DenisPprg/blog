<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
    /**
     * @author Poprugailo Denis <d.poprugailo@piogroup.net>
     * @return Response
     * @Route("/", name="home_page")
     */
    public function index() : Response
    {
        $test = 'Title test';
        return $this->render('default/default.html.twig', [
            'test' => $test,
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
