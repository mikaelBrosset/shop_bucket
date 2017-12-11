<?php
/**
 * Author: Mikael Brosset
 * Email: mikael.brosset@gmail.com
 * Date: 08/12/17
 */
namespace ShoppingListBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ProductRepository extends EntityRepository
{
    public function getAllProducts()
    {
        $qb = $this->createQueryBuilder('prod')
            ->select();
        return $qb->getQuery()->getArrayResult();
    }

    public function getProductsFromCategory($catId)
    {
        $qb = $this->createQueryBuilder('product')
            ->select()
            ->where('product.category = :term')
            ->setParameter('term', $catId);
        return $qb->getQuery()->getArrayResult();
    }

    public function getProductsById($prodId)
    {
        $qb = $this->createQueryBuilder('product')
            ->select()
            ->where('product.id = :term')
            ->setParameter('term', $prodId);
        return $qb->getQuery()->getArrayResult();
    }
}