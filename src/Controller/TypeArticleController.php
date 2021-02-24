<?php

namespace App\Controller;

use App\Entity\TypeArticle;
use App\Form\TypeArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TypeArticleController extends AbstractController
{
    /**
     * @Route("/type/article", name="type_article")
     */
    public function index(): Response
    {
        return $this->render('type_article/index.html.twig', [
            'controller_name' => 'TypeArticleController',
        ]);
    }

    /**
     * @Route("/type_article/create", name="type_article")
     */
    public function create(Request $request): Response
    {
        // 1) build the form
        $type_article = new TypeArticle();
        $form = $this->createForm(TypeArticleType::class, $type_article);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($type_article);
            $entityManager->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user
        }

        return $this->render(
            'type_article/create.html.twig',
            array('form' => $form->createView())
        );
    }
}
