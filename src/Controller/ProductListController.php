<?php

namespace App\Controller;

use App\Entity\ProductList;
use App\Form\ProductListType;
use App\Repository\ProductListRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/product/list")
 */
class ProductListController extends AbstractController
{
    /**
     * @Route("/", name="product_list_index", methods={"GET"})
     */
    public function index(ProductListRepository $productListRepository): Response
    {
        return $this->render('product_list/index.html.twig', [
            'product_lists' => $productListRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="product_list_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $productList = new ProductList();
        $form = $this->createForm(ProductListType::class, $productList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($productList);
            $entityManager->flush();

            return $this->redirectToRoute('product_list_index');
        }

        return $this->render('product_list/new.html.twig', [
            'product_list' => $productList,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="product_list_show", methods={"GET"})
     */
    public function show(ProductList $productList): Response
    {
        return $this->render('product_list/show.html.twig', [
            'product_list' => $productList,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="product_list_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ProductList $productList): Response
    {
        $form = $this->createForm(ProductList1Type::class, $productList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('product_list_index');
        }

        return $this->render('product_list/edit.html.twig', [
            'product_list' => $productList,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="product_list_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ProductList $productList): Response
    {
        if ($this->isCsrfTokenValid('delete'.$productList->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($productList);
            $entityManager->flush();
        }

        return $this->redirectToRoute('product_list_index');
    }
}
