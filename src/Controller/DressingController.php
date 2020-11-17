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
       
        //On récupère l'user connecté
        $connectedUser = $this->getUser();
        //Puis on récupère l'utilisateur :
        $utilisateur = $connectedUser->getUtilisateur();

    $haut = $repo->findBy([ 'categorie'=>'haut', 'client_id' => $utilisateur ]);
    $bas =$repo->findBy(['categorie' => 'bas', 'client_id' => $utilisateur ]);
    $chaussure = $repo->findBy(['categorie' => 'chaussures', 'client_id' => $utilisateur ]);

    
      
      if($req->isMethod("POST")){

            $em=$this->getDoctrine()->getManager();
            $vetement = new Vetement2();

    
            $vetement->setCategorie($req->request->get('categorie'));
            $vetement->setTaille($req->request->get('taille'));
            $vetement->setStyle($req->request->get('style'));
            $vetement->setMarque($req->request->get('marque'));
            $vetement->setCouleur($req->request->get('couleur'));
            $vetement->setClientId($utilisateur);
    
            //On récupère la photo :
             $file = $req->files->get("image"); 
            //on récupère le nom original via : (cf : https://github.com/symfony/symfony/blob/2.8/src/Symfony/Component/HttpFoundation/File/UploadedFile.php#L77 )            
            $fileName = $file->getClientOriginalName();
            //Ici on enregistre JUSTE le nom du fichier (genre toto.jpg)
            $vetement->setPhoto($fileName); 
            //Désormais il faut enregistrer le fichier sur le disque dur :
            // var_dump($this->calculatePortablePath(__DIR__ . "/../../public/uploads")); die();
            $file->move($this->calculatePortablePath(__DIR__ . "/../../public/uploads"), $fileName);
           
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
     
    
       return str_replace("/", DIRECTORY_SEPARATOR, $path);
     
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

            $this->addFlash('success', 'Vêtement supprimé !');

            return $this->redirectToRoute('dressing');
        }



        }


   

