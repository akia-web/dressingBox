<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AleatoireController extends AbstractController
{
    /**
     * @Route("/aleatoire", name="aleatoire")
     */
    public function aleatoire()
    {
        return $this->render('app/aleatoire.html.twig');
    }
}
