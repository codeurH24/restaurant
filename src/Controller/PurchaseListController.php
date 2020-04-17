<?php

namespace App\Controller;

use App\Entity\PurchaseList;
use App\Form\PurchaseListType;
use App\Repository\PurchaseListRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/purchase/list")
 */
class PurchaseListController extends AbstractController
{
    /**
     * @Route("/", name="purchase_list_index", methods={"GET"})
     */
    public function index(PurchaseListRepository $purchaseListRepository): Response
    {
        return $this->render('purchase_list/index.html.twig', [
            'purchase_lists' => $purchaseListRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="purchase_list_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $purchaseList = new PurchaseList();
        $form = $this->createForm(PurchaseListType::class, $purchaseList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($purchaseList);
            $entityManager->flush();

            return $this->redirectToRoute('purchase_list_index');
        }

        return $this->render('purchase_list/new.html.twig', [
            'purchase_list' => $purchaseList,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="purchase_list_show", methods={"GET"})
     */
    public function show(PurchaseList $purchaseList): Response
    {
        return $this->render('purchase_list/show.html.twig', [
            'purchase_list' => $purchaseList,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="purchase_list_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PurchaseList $purchaseList): Response
    {
        $form = $this->createForm(PurchaseListType::class, $purchaseList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('purchase_list_index');
        }

        return $this->render('purchase_list/edit.html.twig', [
            'purchase_list' => $purchaseList,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="purchase_list_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PurchaseList $purchaseList): Response
    {
        if ($this->isCsrfTokenValid('delete'.$purchaseList->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($purchaseList);
            $entityManager->flush();
        }

        return $this->redirectToRoute('purchase_list_index');
    }
}
