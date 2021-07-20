<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;

class LuckyController
{
    /**
     *Example file/actions
     *
     * @Route("/lucky/test", name="lucky_test")
     */
    public function test()
    {
       echo 'Hello Denis';
       die;
    }
}
