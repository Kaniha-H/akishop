<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

    //     $categories = [
    //         [
    //             'name' => 'haut',
    //             'slug' => 'haut',
    //         ],
    //         [
    //             'name' => 'bas',
    //             'slug' => 'bas',
    //         ],
    //         [
    //             'name' => 'pulls à capuche',
    //             'slug' => 'pulls-a-capuche',
    //         ],
    //         [
    //             'name' => 'chapeaux et bonnets',
    //             'slug' => 'chapeaux-et-bonnets',
    //         ],
    //         [
    //             'name' => 'statues',
    //             'slug' => 'statues',
    //         ],
    //         [
    //             'name' => 'peluches',
    //             'slug' => 'peluches',
    //         ],
    //         [
    //             'name' => 'tirages',
    //             'slug' => 'tirages',
    //         ],
    //     ];

    //     for ($i=0; $i < count($categories); $i++) { 
    //         $category = new Category();
    //         $category
    //             ->setName($categories[$i]['name'])
    //             ->getSlug($categories[$i]['slug']);

    //         $manager->persist($category);
    //     }
    //     $manager->flush();
    }
}