<?php
/**
 * Author: Mikael Brosset
 * Email: mikael.brosset@gmail.com
 * Date: 01/12/17
 */
namespace ShopBasketBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ShopBasketBundle\Exception\ElementNotFoundException;

class Basket
{
    private $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getProducts()
    {
        return $this->products->toArray();
    }

    public function addProduct(Product $p)
    {
        $this->products->add($p);
    }

    public function removeProduct(Product $p)
    {
        if ($this->products->contains($p)) {
            $this->products->removeElement($p);
        } else {
            throw new ElementNotFoundException(__CLASS__, $p->getName());
        }
    }

    public function hasProduct(Product $p)
    {
        return $this->products->contains($p) ? true : false;
    }
}