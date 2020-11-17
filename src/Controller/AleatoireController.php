<?php

namespace App\Controller;

use App\Repository\Vetement2Repository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AleatoireController extends AbstractController
{
    /**
     * @Route("/aleatoire", name="aleatoire")
     */
    public function aleatoire(Vetement2Repository $repo){
        // public function truc(VetementRepository $repo){                
        //     $twigArgs = ["haut" => null, "chaussure" => null, "bas" => null];
        // 
        //     foreach($twigArgs as $categorie => $none){
        //         $twigArgs[$categorie] = $repo->findBy(["categorie" => $categorie, "utilisateur" => $utilisateur])
        //     }
        // 
        //     return $this->render("dressing/truc.html.twig", $twigArgs);
        // }
        
        // On récupère l'user connecté
        $connectedUser = $this->getUser();
        // Puis on récupère l'utilisateur :
        $utilisateur = $connectedUser->getUtilisateur();
        // $haut = $repo->findBy([ 'categorie'=>'haut',"utilisateur" => $utilisateur ]);
        $haut = $repo->findBy([ 'categorie'=>'haut', 'client_id' => $utilisateur  ]);
        $bas =$repo->findBy(['categorie' => 'bas', 'client_id' => $utilisateur ]);
        $chaussure = $repo->findBy(['categorie' => 'chaussures', 'client_id' => $utilisateur ]);
        return $this->render("app/aleatoire.html.twig", [
            'hauts'=> $haut,
            'bas' => $bas,
            'chaussures' => $chaussure,
        ]);
     }
}
