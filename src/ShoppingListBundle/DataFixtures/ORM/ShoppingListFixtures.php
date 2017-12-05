<?php
/**
 * Author: Mikael Brosset
 * Email: mikael.brosset@gmail.com
 * Date: 04/12/17
 */
namespace ShoppingListBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use ShoppingListBundle\Entity\Category;
use ShoppingListBundle\Entity\Product;

class ShoppingListFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $catNames = [
            1 => 'nourriture',
            2 => 'boisson',
            3 => 'produit d\'entretien'
        ];

        $products = [
            ['viande'   => 1], ['poisson'  => 1], ['beurre'   => 1], ['fromage'  => 1], ['pâtes'    => 1], ['pommes'   => 1], ['carottes' => 1], ['bananes'  => 1], ['céréales' => 1], ['chocolat' => 1],
            ['coca'     => 2], ['pepsi'    => 2], ['orangina' => 2], ['whisky'   => 2], ['vin'      => 2], ['lait'     => 2], ['champagne' => 2], ['evian'     => 2], ['jus de fruits' => 2], ['grenadine'     => 2],
            ['javel'   => 3], ['sopalin' => 3], ['papier toilette' => 3], ['mouchoirs'  => 3], ['balai'      => 3], ['serpillère' => 3], ['vinaigre'   => 3], ['bicarbonate de soude' => 3]
        ];
        foreach ($catNames as $cid => $cname) {
            $cat = (new Category())->setName($cname)->setId($cid);
            $manager->persist($cat);

            for ($i=0; $i<count($products); $i++) {

                foreach ($products[$i] as $pname => $catId) {
                    if ($cid === $catId) {

                        $p = (new Product())
                            ->setName($pname)
                            ->setCategory($cat);
                        $manager->persist($p);
                    }
                }
            }
        }
        $manager->flush();
        $manager->clear();
    }
}