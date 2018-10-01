<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Commentaire;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');

        for ($i = 1; $i <= 3; $i++) {

            $category = new Category();
            $category->setTitre($faker->sentence())
                ->setDescription($faker->paragraph());

            $manager->persist($category);

        }


        for ($j = 1; $j <= mt_rand(4, 6); $j++) {

            $article = new Article();

            $content = '<p>' . join($faker->paragraphs(5), '</p><p>') . '</p>';

            $article->setTitre($faker->sentence())
                ->setContenu($content)
                ->setImage($faker->imageUrl())
                ->setDateCreation($faker->dateTimeBetween('-6 months'))
                ->setCategory($category);

            $manager->persist($article);
        }

        for ($k = 1; $k <= mt_rand(4, 10); $k++) {

            $comment = new Commentaire();
            $content = '<p>' . join($faker->paragraphs(2), '</p><p>') . '</p>';

            $now = new \DateTime();
            $interval = $now->diff($article->getDateCreation());
            $days = $interval->days;
            $minimum = '-' . $days . 'days';
            $comment->setAuteur($faker->name)
                ->setContenu($content)
                ->setDatepublication($faker->dateTimeBetween($minimum))
                ->setArticle($article);

            $manager->persist($comment);

        }




        $manager->flush();
    }
}