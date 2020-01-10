<?php

namespace App\Controller;

use App\Entity\Vetement2;
use App\Entity\Utilisateur;
use App\Repository\Vetement2Repository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DressingController extends AbstractController
{
    /**
     * @Route("/dressing", name="dressing")
     */
    public function enregistrerVetement(Request $req, Vetement2Repository $repo){
       
        $haut = $repo->findBy([ 'categorie'=>'haut',]);
        $bas =$repo->findBy(['categorie' => 'bas']);
        $chaussure = $repo->findBy(['categorie' => 'chaussures']);
        if ($req->isMethod('POST')){
            dump($req);
            $vetement= new Vetement2();
            //On récupère l'user connecté
            $connectedUser = $this->getUser();
            //Puis on récupère l'utilisateur :
            $utilisateur = $connectedUser->getUtilisateur();

            // $file = $req->request->get('image');
            // $fileData = $req->files->get($file);
            // $file->move($this->getParameter('upload_directory'), $fileData);
            // $vetement->setImage($file);
            
         
            $vetement->setCategorie($req->request->get('categorie'));
            $vetement->setTaille($req->request->get('taille'));
            $vetement->setStyle($req->request->get('style'));
            $vetement->setMarque($req->request->get('marque'));
            $vetement->setCouleur($req->request->get('couleur'));
            $vetement->setClientId($utilisateur);
            $vetement->setPhoto($req->request->get('image')); 
            


            // $fd = fopen("vetements".DIRECTORY_SEPARATOR.$filename, "wb+");
            //     if($fd){
            //     fwrite($fileData, $fd);
            //     } else {
            //     throw HTTPErrorException("Méh j'arrive pas a ouvrir mon fichier de destination :'(");
            //     return new Response("Pouet");
            //     }
            // $vetement->setImageFile($req->request->get('image'));      
            // $vetement->setFilename($req->request->get('image'));    
            $em= $this->getDoctrine()->getManager();
            $em->persist($vetement);
            $em->persist($utilisateur);
            $em->flush();



            // dump($req->request->get('image'));
            // return $this->redirectToRoute('dressing');
        }


        return $this->render("app/admin.html.twig", [
            'hauts'=> $haut,
            'bas' => $bas,
            'chaussures' => $chaussure
        ]);
        }

     /**
     * @Route("/detail/{id}", name="detail")
     * 
     */
        public function detail(Vetement2 $vetement){
         


            return $this->render('app/detail.html.twig',[
                'vetement' => $vetement, // 'article' = mot choisit qu'il faut mettre quand on appelle un élément, article= variable définit plus haut
                
        
                ]);
        }
    


        /**
         * @Route("/delete/{id}", name="delete")
         * @return Response
         */
        public function delete(Vetement2 $vetement){
            $em= $this->getDoctrine()->getManager();
            $em->remove($vetement);
            $em->flush();

            return new Response ('produit supprimé. </a href="{{path(\'dressing\')>"');

            return $this->render('app/delete.html.twig');
        }



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
