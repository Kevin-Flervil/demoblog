<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ArticlesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // La boucle FOR tourne 10 fois car nous voulons créer 10 articles
        for($i = 1; $i <= 11; $i++)
        {
            // Pour pouvoir insérer des données dans la table SQL article, nous devons instancier son entité correspondante (Article), Symfony se sert l'objet entité $article pour injecter les valeurs dans les requetes SQL

            $article = new Article;

        // On fait appel aux setteurs de l'objet entité afin de renseigner les titres, les contenu, les images et les dates des faux articles stockés en BDD

            $article->setTitre("Titre de l'article $i")
                    ->setContenu("Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.")
                    ->setImage("https://picsum.photos/536/354")
                    ->setDate(new \DateTime());

        // Un manager (ObjectManager) en Symfony est un classe permettant, entre autre, de manipuler les lignes de la BDD (INSERT, UPDATE, DELETE)

                    // persist() : méthode issue de la classe ObjectManager permettant de préaprer et de garder en méméoire les requetes d'insertion
            // $data = $bdd->prepare("INSERT INTO article VALUES ('getTitre()', 'getContenu()' etc...)")

                    $manager->persist($article);
        }

    // persist() : méthode issue de la classe ObjectManager permettant véritablement d'executer les requetes d'insertions en BDD

        $manager->flush();
    }
}
