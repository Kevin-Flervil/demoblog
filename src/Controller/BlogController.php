<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{
    /**
     * Méthode permettant d'afficher l'ensemble des articles du blog

     * @Route("/blog", name="blog")
     */
    public function blog(): Response
    {
        $reproArticles = $this->getDoctrine()->getRepository(Article::class);
        dump($reproArticles);

        $article = $reproArticles->findAll();
        dump($article);

        return $this->render('blog/blog.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function home(): Response
    {
        return $this->render('blog/home.html.twig', [
            'title' => 'Vive La Musique', 'age' => 25
        ]);
    }

    /**
     * @Route("/blog/12", name="blog_show")
     */
    public function show(): Response
    {
        return $this->render('blog/show.html.twig');
    }
}
