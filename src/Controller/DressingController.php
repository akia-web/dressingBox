<?php

namespace App\Controller;

use App\Entity\Vetement2;
use App\Entity\Utilisateur;
use App\Repository\Vetement2Repository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DressingController extends AbstractController
{
    /**
     * @Route("/dressing", name="dressing")
     */
    public function enregistrerVetement(Request $req, Vetement2Repository $repo){
        $vetements = $repo->findBy([ 'categorie'=>'haut']);
        if ($req->isMethod('POST')){
            $vetement= new Vetement2();
            //On récupère l'user connecté
            $connectedUser = $this->getUser();
            //Puis on récupère l'utilisateur :
            $utilisateur = $connectedUser->getUtilisateur();


            $vetement->setCategorie($req->request->get('categorie'));
            $vetement->setTaille($req->request->get('taille'));
            $vetement->setStyle($req->request->get('style'));
            $vetement->setMarque($req->request->get('marque'));
            $vetement->setCouleur($req->request->get('couleur'));
            $vetement->setClientId($utilisateur);
            $vetement->setPhoto($req->request->get('image'));
            $em= $this->getDoctrine()->getManager();
            $em->persist($vetement);
            $em->persist($utilisateur);
            $em->flush();
            dump($vetement);
            return $this->redirectToRoute('dressing');
        }


        return $this->render("app/admin.html.twig", [
            'hauts'=> $vetements,
        ]);
        }
    

    // /**
    //  * @Route("/dressing", name="dressing")
    //  */
    // public function haut(Vetement2Repository $repo){
    //     $vetements = $repo->findBy([ 'categorie'=>'haut']);
    //     return $this->render('app/admin.html.twig', [
    //         'hauts'=> $vetements,
    //     ]);

    // }


    
    // /**
    //  * @Route("/dressing", name="dressing")
    //  */
    // public function bas(Vetement2Repository $repo){
    //     $vetements = $repo->findBy([ 'categorie'=>'bas']);
    //     return $this->render('app/admin.html.twig', [
    //         'bas'=> $vetements,
    //     ]);

    // }
}