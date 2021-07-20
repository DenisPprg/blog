<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;

class UserController
{
    /**
     * @Route("/user/register", name="user_register")
     */
    public function registerAction()
    {
        echo 'registerAction';
        die;
    }
}