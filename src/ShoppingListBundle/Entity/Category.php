<?php
/**
 * Author: Mikael Brosset
 * Email: mikael.brosset@gmail.com
 * Date: 01/12/17
 */
namespace ShoppingListBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ShoppingListBundle\Exception\ElementNotFoundException;

/**
 * @ORM\Entity
 */
class Category
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Product", mappedBy="category")
     */
    private $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = ucfirst($name);
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getProducts()
    {
        return $this->products->toArray();
    }

    public function addProduct(Product $p)
    {
        if (!$this->products->contains($p)) {
            $this->products->add($p);
        }
        return $this;
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