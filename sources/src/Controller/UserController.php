<?php

namespace App\Controller;

use Doctrine\DBAL\Statement;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{
    /**
     * @author Poprugailo Denis <d.poprugailo@piogroup.net>
     * @Route("/user/register", name="user_register")
     * @return Response
     */
    public function registerAction() : Response
    {
        return $this->render('user/user.html.twig');
    }
}
