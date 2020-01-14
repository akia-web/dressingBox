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

        $connectUser= $this->getUtilisateur();
        $utilisateur= $connectUser->getUtilisateur();
        $haut = $repo->findBy([ 'categorie'=>'haut', 'style' => 'sportswear', 'id_client'=>$utilisateur]);
        $bas =$repo->findBy(['categorie' => 'bas', 'style' => 'sportswear', 'id_client'=>$utilisateur ]);
        $chaussure = $repo->findBy(array('categorie' => 'chaussures', 'style' => 'sportswear', 'id_client'=>$utilisateur));



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

        $haut = $repo->findBy([ 'categorie'=>'haut', 'style' => 'classic', 'id_client'=>$utilisateur]);
        $bas =$repo->findBy(['categorie' => 'bas', 'style' => 'classic', 'id_client'=>$utilisateur ]);
        $chaussure = $repo->findBy(['categorie' => 'chaussures', 'style' => 'classic', 'id_client'=>$utilisateur]);



        return $this->render('app/style.html.twig',[
            'hauts'=> $haut,
            'bas' => $bas,
            'chaussures' => $chaussure,
        ]);
    }
  /**
     * @Route("/chic", name="chic")
     */
    public function chic(Vetement2Repository $repo)
    {

        $haut = $repo->findBy([ 'categorie'=>'haut', 'style' => 'chic', 'id_client'=>$utilisateur]);
        $bas =$repo->findBy(['categorie' => 'bas', 'style' => 'chic', 'id_client'=>$utilisateur ]);
        $chaussure = $repo->findBy(array('categorie' => 'chaussures', 'style' => 'chic', 'id_client'=>$utilisateur));



        return $this->render('app/style.html.twig',[
            'hauts'=> $haut,
            'bas' => $bas,
            'chaussures' => $chaussure,
        ]);
    }
/**
     * @Route("/cocooning", name="cocooning")
     */
    public function cocooning(Vetement2Repository $repo)
    {

        $haut = $repo->findBy([ 'categorie'=>'haut', 'style' => 'cocooning', 'id_client'=>$utilisateur]);
        $bas =$repo->findBy(['categorie' => 'bas', 'style' => 'cocooning', 'id_client'=>$utilisateur ]);
        $chaussure = $repo->findBy(['categorie' => 'chaussures', 'style' => 'cocooning', 'id_client'=>$utilisateur]);



        return $this->render('app/style.html.twig',[
            'hauts'=> $haut,
            'bas' => $bas,
            'chaussures' => $chaussure,
        ]);
    }



}
