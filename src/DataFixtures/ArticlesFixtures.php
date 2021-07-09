<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\Article;
use App\Entity\Comment;
use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ArticlesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // On importe la librairie Faker pour les fixtures, cela nous permet de créer des fausses articles, catégories, commentaires plus évolués avec par exemple des faux noms, faux prénoms, date aléatoires etc...
        $faker = \Faker\Factory::create('fr_FR');

        for($cat = 1; $cat <= 3; $cat++)
        {
            $category = new Category;

            $category->setTitre($faker->word)
                    ->setDescription($faker->paragraph());

            $manager->persist($category);

            for($art = 1; $art <= mt_rand(4,10); $art++)
            {
                $article = new Article;

                $article->setTitre($faker->sentence())
                        ->setContenu($faker->paragraph(5))
                        ->setImage($faker->imageUrl(600,600))
                        ->setDate($faker->dateTimeBetween('-6 months'))
                        ->setCategory($category);

                $manager->persist($article);

                for($cmt = 1; $cmt <= mt_rand(4,10); $cmt++)
                {
                    $comment = new Comment;

                    $now = new DateTime;
                    $interval = $now->diff($article->getDate());

                    $days = $interval->days;

                    $minimum = "-$days days";

                    $comment->setAuteur($faker->name)
                            ->setCommentaire($faker->paragraph(2))
                            ->setDate($faker->dateTimeBetween($minimum))
                            ->setArticle($article);
                        
                    $manager->persist($comment);
                }
            }
        }

        $manager->flush();
    }
}
    // Un manager (ObjectManager) en Symfony est un classe permettant, entre autre, de manipuler les lignes de la BDD (INSERT, UPDATE, DELETE)

   // persist() : méthode issue de la classe ObjectManager permettant véritablement d'executer les requetes d'insertions en BDD

   // On fait appel aux setteurs de l'objet entité afin de renseigner les titres, les contenu, les images et les dates des faux articles stockés en BDD

   // Pour pouvoir insérer des données dans la table SQL article, nous devons instancier son entité correspondante (Article), Symfony se sert l'objet entité $article pour injecter les valeurs dans les requetes SQL

    // La boucle FOR tourne 10 fois car nous voulons créer 10 articles

                    // persist() : méthode issue de la classe ObjectManager permettant de préaprer et de garder en méméoire les requetes d'insertion
                    
            // $data = $bdd->prepare("INSERT INTO article VALUES ('getTitre()', 'getContenu()' etc...)")