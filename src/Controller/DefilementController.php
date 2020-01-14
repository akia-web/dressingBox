<?php

namespace App\Controller;

use App\Entity\Vetement2;
use App\Repository\Vetement2Repository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefilementController extends AbstractController
{
    /**
     * @Route("/defilement", name="defilement")
     */
    public function defilement(Vetement2Repository $repo){
      
                // On récupère l'user connecté
                $connectedUser = $this->getUser();
                // Puis on récupère l'utilisateur :
               $utilisateur = $connectedUser->getUtilisateur();
        // $haut = $repo->findBy([ 'categorie'=>'haut',"utilisateur" => $utilisateur ]);
        $haut = $repo->findBy([ 'categorie'=>'haut',  'client_id' => $utilisateur ]);
        $bas =$repo->findBy(['categorie' => 'bas','client_id' => $utilisateur  ]);
        $chaussure = $repo->findBy(['categorie' => 'chaussures', 'client_id' => $utilisateur ]);
        return $this->render("app/defilement.html.twig", [
            'hauts'=> $haut,
            'bas' => $bas,
            'chaussures' => $chaussure,
        ]);
     }
    }

    



