<?php

namespace App\Controller;

use App\Entity\Vetement2;
use App\Form\Vetement2Type;
use App\Repository\Vetement2Repository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/vetement2")
 */
class Vetement2Controller extends AbstractController
{
    /**
     * @Route("/", name="vetement2_index", methods={"GET"})
     */
    public function index(Vetement2Repository $vetement2Repository): Response
    {
        return $this->render('vetement2/index.html.twig', [
            'vetement2s' => $vetement2Repository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="vetement2_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $vetement2 = new Vetement2();
        $form = $this->createForm(Vetement2Type::class, $vetement2);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($vetement2);
            $entityManager->flush();

            return $this->redirectToRoute('vetement2_index');
        }

        return $this->render('vetement2/new.html.twig', [
            'vetement2' => $vetement2,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="vetement2_show", methods={"GET"})
     */
    public function show(Vetement2 $vetement2): Response
    {
        return $this->render('vetement2/show.html.twig', [
            'vetement2' => $vetement2,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="vetement2_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Vetement2 $vetement2): Response
    {
        $form = $this->createForm(Vetement2Type::class, $vetement2);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('vetement2_index');
        }

        return $this->render('vetement2/edit.html.twig', [
            'vetement2' => $vetement2,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="vetement2_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Vetement2 $vetement2): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vetement2->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($vetement2);
            $entityManager->flush();
        }

        return $this->redirectToRoute('vetement2_index');
    }
}
