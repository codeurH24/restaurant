<?php

namespace App\Controller;

use App\Entity\Desire;
use App\Form\DesireType;
use App\Repository\DesireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/desire")
 */
class DesireController extends AbstractController
{
    /**
     * @Route("/", name="desire_index", methods={"GET"})
     */
    public function index(DesireRepository $desireRepository): Response
    {
        return $this->render('desire/index.html.twig', [
            'desires' => $desireRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="desire_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $desire = new Desire();
        $form = $this->createForm(DesireType::class, $desire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($desire);
            $entityManager->flush();

            return $this->redirectToRoute('desire_index');
        }

        return $this->render('desire/new.html.twig', [
            'desire' => $desire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="desire_show", methods={"GET"})
     */
    public function show(Desire $desire): Response
    {
        return $this->render('desire/show.html.twig', [
            'desire' => $desire,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="desire_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Desire $desire): Response
    {
        $form = $this->createForm(DesireType::class, $desire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('desire_index');
        }

        return $this->render('desire/edit.html.twig', [
            'desire' => $desire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="desire_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Desire $desire): Response
    {
        if ($this->isCsrfTokenValid('delete'.$desire->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($desire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('desire_index');
    }
}
