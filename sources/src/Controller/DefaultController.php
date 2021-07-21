<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
    /**
     *Example file/actions
     *
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
     * @Route("/about", name="default_about")
     */
    public function about()
    {
        return $this->render('default/about.html.twig');
    }

    /**
     * @Route("/feedback", name="default_feedback")
     */
    public function feedback()
    {
        return $this->render('default/feedback.html.twig');
    }
}