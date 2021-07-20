<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;

class NumberController
{
    /**
     * @Route("/number", name="number_controller")
     */
    public function number()
    {
        $number = rand(1, 100);
        echo 'Number is: '.$number;
        die;
    }
}