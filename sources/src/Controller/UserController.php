<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{
    /**
     * @Route("/user/register", name="user_register")
     */
    public function registerAction() : Response
    {
        return $this->render('/user/user.html.twig');
    }
}