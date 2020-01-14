<?php

namespace App\Controller;

use App\Repository\Vetement2Repository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StyleController extends AbstractController
{



   /**
     * @Route("/sportwear", name="sportwear")
     */
    public function sportwear(Vetement2Repository $repo)
    {

        $haut = $repo->findBy([ 'categorie'=>'haut', 'style' => 'sportswear']);
        $bas =$repo->findBy(['categorie' => 'bas', 'style' => 'sportswear' ]);
        $chaussure = $repo->findBy(array('categorie' => 'chaussures', 'style' => 'sportswear'));



        return $this->render('app/style.html.twig',[
            'hauts'=> $haut,
            'bas' => $bas,
            'chaussures' => $chaussure,
        ]);
    }

 /**
     * @Route("/classic", name="classic")
     */
    public function classic(Vetement2Repository $repo)
    {

        $haut = $repo->findBy([ 'categorie'=>'haut', 'style' => 'classic']);
        $bas =$repo->findBy(['categorie' => 'bas', 'style' => 'classic' ]);
        $chaussure = $repo->findBy(array('categorie' => 'chaussures', 'style' => 'classic'));



        return $this->render('app/style.html.twig',[
            'hauts'=> $haut,
            'bas' => $bas,
            'chaussures' => $chaussure,
        ]);
    }




}
