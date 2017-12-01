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

/**
 * @ORM\Entity
 */
class Product
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", nullable="false")
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="Category", inversedBy="products")
     */
    private $categories;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
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
        $this->name = $name;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getCategories()
    {
        return $this->categories->toArray();
    }

    public function addCategory(Category $cat)
    {
        if (!$this->categories->contains($cat)) {
            $this->categories->add($cat);
        }
        return $this;
    }

    public function removeCategory(Category $cat)
    {
        if ($this->categories->contains($cat)) {
            $this->categories->removeElement($cat);
        } else {
            throw new ElementNotFoundException(__CLASS__, $cat->getName());
        }
    }

    public function hasCategory(Category $cat)
    {
        return $this->categories->contains($cat) ? true : false;
    }
}