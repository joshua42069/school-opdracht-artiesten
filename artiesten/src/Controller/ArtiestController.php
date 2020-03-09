<?php

namespace App\Controller;

use App\Entity\Artiest;
use App\Form\ArtiestType;
use App\Repository\ArtiestRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/artiest")
 */
class ArtiestController extends AbstractController
{
    /**
     * @Route("/", name="artiest_index", methods={"GET"})
     */
    public function index(ArtiestRepository $artiestRepository): Response
    {
        return $this->render('artiest/index.html.twig', [
            'artiests' => $artiestRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="artiest_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $artiest = new Artiest();
        $form = $this->createForm(ArtiestType::class, $artiest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($artiest);
            $entityManager->flush();

            return $this->redirectToRoute('artiest_index');
        }

        return $this->render('artiest/new.html.twig', [
            'artiest' => $artiest,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="artiest_show", methods={"GET"})
     */
    public function show(Artiest $artiest): Response
    {
        return $this->render('artiest/show.html.twig', [
            'artiest' => $artiest,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="artiest_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Artiest $artiest): Response
    {
        $form = $this->createForm(ArtiestType::class, $artiest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('artiest_index');
        }

        return $this->render('artiest/edit.html.twig', [
            'artiest' => $artiest,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="artiest_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Artiest $artiest): Response
    {
        if ($this->isCsrfTokenValid('delete'.$artiest->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($artiest);
            $entityManager->flush();
        }

        return $this->redirectToRoute('artiest_index');
    }
}
