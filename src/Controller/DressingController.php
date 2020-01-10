<?php

namespace App\Controller;

use App\Entity\Vetement2;
use App\Entity\Utilisateur;
use App\Form\Vetement2Type;
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

     //On récupère l'user connecté
       $connectedUser = $this->getUser();
    //Puis on récupère l'utilisateur :
      $utilisateur = $connectedUser->getUtilisateur();
      
      if($req->isMethod("POST")){

            $em=$this->getDoctrine()->getManager();
            $vetement = new Vetement2();

//ça, ça sert pour les formulaires, nous, on en veut pas. (Déjà on fait marcher dans form)
            $vetement->setCategorie($req->request->get('categorie'));
            $vetement->setTaille($req->request->get('taille'));
            $vetement->setStyle($req->request->get('style'));
            $vetement->setMarque($req->request->get('marque'));
            $vetement->setCouleur($req->request->get('couleur'));
            $vetement->setClientId($utilisateur);
            
            //Ok donc le formulaire est enctype="multipart/form-data"
  
       //On récupère la photo :
         //Ici avec $req->files->get() on récupère un objet de type FileBag cf code source : https://github.com/symfony/symfony/blob/2.8/src/Symfony/Component/HttpFoundation/File/UploadedFile.php
            $file = $req->files->get("image"); 
            
            //PHP lorsqu'il reçoit un fichier uploadé, il l'enregistrer dans un endroit temporaire le temps que la requête soit traitée, donc il a un nom temporaire
            //on récupère le nom original via : (cf : https://github.com/symfony/symfony/blob/2.8/src/Symfony/Component/HttpFoundation/File/UploadedFile.php#L77 )            
            $fileName = $file->getClientOriginalName();
            //Ici on enregistre JUSTE le nom du fichier (genre toto.jpg)
            $vetement->setPhoto($fileName); 
            
            //Désormais il faut enregistrer le fichier sur le disque dur :
            //!\\ ************************************************** //!\\
            // On enregistre le fichier sur le bureau !! On ne pourra pas la servir
            // via le serveur web.
            $file->move($this->calculatePortablePath(__DIR__."/../../uploads/"), $fileName);
            
            //!\\ ************************************************** //!\\
            
            //That's it.
            $em->persist($vetement);
            $em->persist($utilisateur);
            $em->flush();

            return $this->redirectToRoute('dressing');
        }

         
        return $this->render("app/admin.html.twig", [
            'hauts'=> $haut,
            'bas' => $bas,
            'chaussures' => $chaussure,
        ]);
    }
    

    private function calculatePortablePath($path){
        //On vérifie qu'on tourne sur Windows, pas besoin de faire le traitement sous Linux :
        if(PHP_OS == "Windows"){
       return str_replace("/", DIRECTORY_SEPARATOR, path);
        }
        else
            return $path;
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


   

