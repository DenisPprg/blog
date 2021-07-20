<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;

class DefaultController
{
    /**
     *Example file/actions
     *
     * @Route("/", name="home_page")
     */
    public function index()
    {
        echo 'Hello World';
        die;
    }
}