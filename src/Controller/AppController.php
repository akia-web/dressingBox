<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AppController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('app/index.html.twig', [
            'controller_name' => 'AppController',
        ]);
    }

    /**
     * @Route("/admin", name="admin")

     */
    public function admin()
    {
        try{
            $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'accès interdit!');
        }catch(\Throwable $th){
            return $this->redirectToRoute('app_login');
        }
        return $this->render('app/admin.html.twig');
    }

}
