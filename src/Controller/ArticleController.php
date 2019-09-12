<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\PropertySearch;
use App\Form\ArticleType;
use App\Form\PropertySearchType;
use App\Repository\ArticleRepository;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/article")
 */
class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="article_index", methods={"GET","POST"})
     */

    public function index(ArticleRepository $articleRepository,  Request $request): Response
    {
        $search = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class, $search, ['action' => 'searchByCouleur']);
        $form->handleRequest($request);
        //===================================================================================================

        $articles = $articleRepository->findAll();
        
        return $this->render('article/index.html.twig', [
            'articles' => $articles,
            'form' => $form->createView(),
            

        ]);
    }

    /**
     * @Route("/search/{id}", name="article_search", methods={"GET"})
     */
    public function search(ArticleRepository $articleRepository, $id, CategorieRepository $CategorieRepository): Response
    {
        //return $this->render('article/search.html.twig', [//
        return $this->render('categorie/show.html.twig', [
            'articles' => $articleRepository->findByCategoryId($id),
            'categorie' => $CategorieRepository->find($id)
        ]);
    }

    /**
     * @Route("/searchByCouleur", name="article_search_couleur", methods={"POST"})
     */
    public function searchByCouleur(ArticleRepository $articleRepository, Request $request): Response
    {
        $couleur = $request->get('couleur') ?? null;
        //var_dump($couleur);die();

        return $this->render('article/recherche.html.twig', [
            'articles' => $articleRepository->findByCouleur($couleur),
            'couleur' => $couleur
        ]);
    }









    /**
     * @Route("/new", name="article_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        //$article = new Article();
        //$article->setCouleur('rouge');
        $form = $this->createForm(ArticleType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $article = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('article_index');
        }

        return $this->render('article/new.html.twig', [
            
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="article_show", methods={"GET"})
     */
    public function show(Article $article): Response
    {
        return $this->render('article/show.html.twig', [
            'article' => $article,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="article_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Article $article): Response
    {
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('article_index');
        }

        return $this->render('article/edit.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="article_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Article $article): Response
    {
        if ($this->isCsrfTokenValid('delete' . $article->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($article);
            $entityManager->flush();
        }

        return $this->redirectToRoute('article_index');
    }
}
