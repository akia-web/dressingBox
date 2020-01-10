<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StyleController extends AbstractController
{
    /**
     * @Route("/style", name="style")
     */
    public function style()
    {
        return $this->render('app/style.html.twig');
    }
}
