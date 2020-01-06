<?php

namespace App\Controller;


use App\Entity\User;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        return $this->redirectToRoute('home'); 
    }

    /**
     * @Route("register", name="app_register")
     */
    public function register(Request $req, UserPasswordEncoderInterface $encoder ){
        if ($req->isMethod('POST')){
            $user= new User();
            $user->setEmail($req->request->get('email'));
            $user->setPassword($encoder->encodePassword($user, $req->request->get('password')));
            $user->setRoles(['ROLE_USER']);
            $em= $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('home');
        }


        return $this->render("security/register.html.twig");
    }

    /**
     * @Route ("/forgottenpassword", name="app_forgotten_password")
     */

     public function forgottenPassword(Request $req, TokenGeneratorInterface $tokenGenerator, MailerInterface $mailer){
         if($req->isMethod('POST')){
             $email = $req->request->get('email');
             $repo = $this->getDoctrine()->getRepository(User::class);
             $user = $repo->findOneByEmail($email);

             if($user===null){
                 $this->addFlash('danger','lalala trompé!');
                 return $this->redirectToRoute('home');
                }


             $em= $this->getDoctrine()->getManager();
             $token = $tokenGenerator -> generateToken();
             
             try{
                 $user->setToken($token);
                 $em->persist($user);
                 $em->flush();
             }catch(\throwable $th){
                 $this->addFlash('danger','erreur');
                 return $this->redirectToRoute('home');
             }


             $url = $this->generateUrl('app_reset_password', ['token'=> $token]);

             $email = (new Email())
             ->from('ch.royer15@gmail.com')
             ->to ($user->getEmail())
             ->subject('réinitialisation du mot de passe')
             ->html('<p>lien ; '. $url. '</p>');

             $mailer->send($email);
             $this->addFlash('notice','message envoyé');
             return $this->redirectToRoute('home');

         }
        return $this->render('security/forgottenpassword.html.twig');
     }

        /**
     * @Route ("/reset_password/{token}", name="app_reset_password")
     */
    public function resetPassword(Request $req, string $token, UserPasswordEncoderInterface $encoder){
        if($req->isMethod('POST')){
            $em= $this->getDoctrine()->getManager();
            $repo = $this->getDoctrine()->getRepository(User::class);

            $user = $repo->findOneByToken($token);
            if($user === null){
                $this->addFlash('danger', 'token inconnu...');
                return $this->redirectToRoute('home');
            }

            $user->setToken(null);
            $user->setPassword($encoder->encodePassword($user, $req->get('password')));
            $em->persist($user);
            $em->flush();
            $this->addFlash('notice', 'mot de passe enregistré');
            $this->redirectToRoute('home');
        }

        return $this->render('security/reset_password.html.twig',[
            'token'=> $token
        ]);
    }
}

