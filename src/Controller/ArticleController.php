<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class ArticleController extends AbstractController
{

    /**
     * @Route("/article/new", name="article_create")
     */
    public function create(Request $request, SluggerInterface $slugger): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();

            // return $this->redirectToRoute('app_product_list');
        }


            return $this->render('article/create.html.twig', [
                'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/article/{id}", name="article_show")
     */

    public function show(int $id) : Response {
        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->find($id);

        return $this->render('article/show.html.twig', [
            'article' => $article,
            'dossierImage' => $this->getParameter('images_dossier'),
        ]);
    }

    /**
     * @Route("/article/edit/{id}", name="article_edit")
     */
    public function edit (Request $request, int $id, SluggerInterface $slugger) : Response {

        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->find($id);

        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $oldImage = $article->getImage();
            unlink($this->getParameter('images_dossier').'/'.$oldImage);
            $article = $form->getData();

            /** @var UploadedFile $imageFile */
            $imageFile = $form->get('image')->getData();

            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();

                try {
                    $imageFile->move(
                        $this->getParameter('images_dossier'),
                        $newFilename
                    );
                } catch (FileException $e) {
                }

                $article->setImage($newFilename);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();

            /*
             * return $this->redirectToRoute('article_show', [
                'id' => $id,
            ]);
             */
        }
        return $this->render('article/edit.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/article/{id}/delete", name="article_delete")
     * @return RedirectResponse
     */
    public function delete(Article $article): RedirectResponse
    {

        $oldImage = $article->getImage();
        unlink($this->getParameter('images_dossier').'/'.$oldImage);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($article);
        $entityManager->flush();

        return $this->redirectToRoute('article_admin');

    }

    /**
     * @Route("/admin/articles", name="article_admin")
     */
    public function getAllArticles(){
        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();

        return $this->render('admin/article/list.html.twig', [
            'articles' => $articles
        ]);
    }
}
