<?php

namespace App\Controller;

use App\Entity\Optreden;
use App\Form\OptredenType;
use App\Repository\OptredenRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/optreden")
 */
class OptredenController extends AbstractController
{
    /**
     * @Route("/", name="optreden_index", methods={"GET"})
     */
    public function index(OptredenRepository $optredenRepository): Response
    {
        return $this->render('optreden/index.html.twig', [
            'optredens' => $optredenRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="optreden_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $optreden = new Optreden();
        $form = $this->createForm(OptredenType::class, $optreden);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($optreden);
            $entityManager->flush();

            return $this->redirectToRoute('optreden_index');
        }

        return $this->render('optreden/new.html.twig', [
            'optreden' => $optreden,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="optreden_show", methods={"GET"})
     */
    public function show(Optreden $optreden): Response
    {
        return $this->render('optreden/show.html.twig', [
            'optreden' => $optreden,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="optreden_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Optreden $optreden): Response
    {
        $form = $this->createForm(OptredenType::class, $optreden);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('optreden_index');
        }

        return $this->render('optreden/edit.html.twig', [
            'optreden' => $optreden,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="optreden_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Optreden $optreden): Response
    {
        if ($this->isCsrfTokenValid('delete'.$optreden->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($optreden);
            $entityManager->flush();
        }

        return $this->redirectToRoute('optreden_index');
    }
}
