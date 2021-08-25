<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class LuckyController extends AbstractController
{
    /**
     * @author Poprugailo Denis <d.poprugailo@piogroup.net>
     * @return Response
     */
    public function test() : Response
    {
        return $this->render('lucky/lucky.html.twig');
    }
}
