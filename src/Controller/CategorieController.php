<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CategorieType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategorieController extends AbstractController
{
    /**
     * @Route("/categorie/new", name="categorie_create")
     */
    public function create(Request $request): Response
    {
        $categorie = new Categorie();
        $form = $this->createForm(CategorieType::class, $categorie);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($categorie);
            $entityManager->flush();
        }

        return $this->render(
            'categorie/create.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * @Route("categorie/edit/{id}", name="categorie_edit")
     */
    public function edit(Request $request, int $id){
        $categorie = $this->getDoctrine()->getRepository(Categorie::class)->find($id);
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($categorie);
            $entityManager->flush();
        }

        return $this->render('categorie/edit.html.twig',[
                'form' => $form->createView()
            ]
        );
    }

    /**
     * @Route("categorie/delete/{id}", name="categorie_delete")
     * @return RedirectResponse
     */

    public function delete(Categorie $categorie): RedirectResponse{

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($categorie);
        $entityManager->flush();

        return $this->redirectToRoute('categorie_admin');
    }


    /**
     * @Route("admin/categories", name="categories_admin")
     */

    public function getAllTypes(){
        $categories = $this->getDoctrine()->getRepository(Categorie::class)->findAll();

        return $this->render('admin/categories/list.html.twig', [
            'categories' => $categories
        ]);
    }


}
