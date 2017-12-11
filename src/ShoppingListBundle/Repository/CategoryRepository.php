<?php
/**
 * Author: Mikael Brosset
 * Email: mikael.brosset@gmail.com
 * Date: 08/12/17
 */
namespace ShoppingListBundle\Repository;

use Doctrine\ORM\EntityRepository;

class CategoryRepository extends EntityRepository
{
    public function getAllCategories()
    {
        $qb = $this->createQueryBuilder('cat')
            ->select();
        return $qb->getQuery()->getArrayResult();
    }
}