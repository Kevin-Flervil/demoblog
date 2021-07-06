<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{
    /**
     * Méthode permettant d'afficher l'ensemble des articles du blog

     * @Route("/blog", name="blog")
     */
    public function blog(ArticleRepository $reproArticles): Response
    {
        // Pour selectionner des données dans une table SQL en BDD? nous devons importer la classe Repository qui correspond à la table SQL, c'est à dire à l'entité correspondante (Article)
        // Une classe Repository permet uniquement de formuler et d'executer des requetes SQL de selection (SELECT)
        // Cette classe contient des méthodes mis à disposition par Symfony pour formuler et executer des requetes SQL en BDD
        // getRepository() : méthode permettant d'importer la classe Repository d'une entité

        // $reproArticles = $this->getDoctrine()->getRepository(Article::class);
        dump($reproArticles);

        $articles = $reproArticles->findAll();
        dump($articles);

        return $this->render('blog/blog.html.twig', [
            'articleBDD' => $articles
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
     * @Route("/blog/new", name="blog_create")
     */
    public function create(): Response
    {
        return $this->render('blog/create.html.twig');
    }
    
    /**
     * @Route("/blog/{id}", name="blog_show")
     */
    // L'id transmit dans l'URL est envoyé directement en argument de la fonction show(), ce qui nous permet d'avoir accès à l'id de l'article a selectionner en BDD au sein de la méthode show()

    public function show(Article $article): Response
    {
        // dump($id);

        // $reproArticle = $this->getDoctrine()->getRepository(Article::class);
        // dump($reproArticle);
        // find() : méthode mise à dispostion par Symfony issue de la classe ArticleRepository permettant de selectionner un élément de la BDD par son ID 
        // $article : tableau ARRAY contenant toutes les données de l'article selectionné en BDD en fonction de l'ID transmit dans l'URL
        // SELECT * FROM article WHERE id = 6 + FETCH

        // $article = $reproArticle->find($id);
        dump($article);

        return $this->render('blog/show.html.twig', [
            'articleBDD' => $article // on transmet au template les données de l'article selectionné en BDD afin de les traiter avec le langage Twig dans le template

        ]);
    }
}
