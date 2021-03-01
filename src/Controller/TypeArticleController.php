<?php

namespace App\Controller;

use App\Entity\TypeArticle;
use App\Form\TypeArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TypeArticleController extends AbstractController
{

    /**
     * @Route("/type_article/new", name="type_article_create")
     */
    public function create(Request $request): Response
    {
        $type_article = new TypeArticle();
        $form = $this->createForm(TypeArticleType::class, $type_article);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($type_article);
            $entityManager->flush();

            return $this->redirectToRoute('type_article_admin');
        }

        return $this->render(
            'type_article/create.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * @Route("type_article/edit/{id}", name="type_article_edit")
     */
    public function edit(Request $request, int $id){
        $type = $this->getDoctrine()->getRepository(TypeArticle::class)->find($id);
        $form = $this->createForm(TypeArticleType::class, $type);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($type);
            $entityManager->flush();
        }

        return $this->render('type_article/edit.html.twig',[
            'form' => $form->createView()
            ]
        );
    }

    /**
     * @Route("type_article/delete/{id}", name="type_article_delete")
     * @return RedirectResponse
     */

    public function delete(TypeArticle $type): RedirectResponse{

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($type);
        $entityManager->flush();

        return $this->redirectToRoute('type_article_admin');
    }

    /**
     * @Route("admin/types_article", name="type_article_admin")
     */

    public function getAllTypes(){
        $types = $this->getDoctrine()->getRepository(TypeArticle::class)->findAll();

        return $this->render('admin/types/list.html.twig', [
            'types' => $types
        ]);
    }
}
