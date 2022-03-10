<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $sushisCategory = ['Sushi', 'Sashimi', 'Maki', 'California', 'Menu', 'Boisson', 'Dessert'];
        $productNames = [
            'sushi crevette', 'sushi avocat', 'sushi thon', 'sushi saumon',
            'sashimi thon', 'sashimi saumon', 'sashimi mixte',
            'maki saumon', 'maki avocat', 'maki thon', 'maki concombre',
            'california saumon avocat', 'california thon avocat', 'california tempura avocat', 'california crevette avocat', 'california concombre avocat',
            'full saumon', 'full veggie', 'full thon', 'full crevette', 'full mixte', 'full full',
            'sake', 'coca', 'asahi', 'coedo shiro', 'orangina', 'evian', 'badoit', 'ice-tea',
            'mochi coco', 'mochi mangue', 'tiramisu café', 'tiramisu chocolat', 'sweet sushi mangue anette'
        ];
        $prices = [500, 400, 490, 450, 1290, 1190, 1290, 590, 590, 590, 590, 650, 650, 790, 650, 650, 1690, 1490, 1750, 1650, 1550, 30090, 990, 270, 390, 490, 250, 270, 270, 250, 270, 270, 450, 450, 270];



        // $product = new Product();
        $categories = [];

        foreach ($sushisCategory as $value) {
            $category = new Category();
            $category->setName($value);
            $manager->persist($category);
            $categories[] = $category;
        }

        for ($i = 0; $i < count($productNames); $i++) {
            $sushi = new Product();
            $sushi->setName($productNames[$i]);
            $sushi->setPrice($prices[$i]);
            $sushi->setImage(str_replace(' ', '-', $productNames[$i]) . '.png');

            switch ($i) {
                case $i < 4:
                    $sushi->setCategory($categories[0]);
                    break;

                case $i < 7:
                    $sushi->setCategory($categories[1]);
                    break;

                case $i < 11:
                    $sushi->setCategory($categories[2]);
                    break;

                case $i < 16:
                    $sushi->setCategory($categories[3]);
                    break;

                case $i < 22:
                    $sushi->setCategory($categories[4]);
                    break;

                case $i < 30:
                    $sushi->setCategory($categories[5]);
                    break;

                case $i >= 30:
                    $sushi->setCategory($categories[6]);
                    break;
            }

            $manager->persist($sushi);
        }

        $manager->flush();

        // $manager->persist($product);

    }
}
