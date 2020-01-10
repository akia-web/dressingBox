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
    public function defilement( Vetement2 $vetement, Vetement2Repository $repo, Request $req){
    // $haut = $repo->findBy(['categorie'=>'haut']);
    
    // $connectedUser = $this->getUser();
    // $utilisateur = $connectedUser->getUtilisateur();
   

        return $this->render('app/defilement.html.twig',);
    }


    
}


