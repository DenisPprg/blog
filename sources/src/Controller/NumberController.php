<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;

class NumberController
{
    /**
     * @author Poprugailo Denis <d.poprugailo@piogroup.net>
     * @Route("/number", name="number_controller")
     * @return void
     */
    public function number()
    {
        $number = rand(1, 100);
        echo 'Number is: '.$number;
        die;
    }
}
