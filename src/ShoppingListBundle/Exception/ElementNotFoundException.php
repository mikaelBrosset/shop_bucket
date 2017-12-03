<?php
/**
 * Author: Mikael Brosset
 * Email: mikael.brosset@gmail.com
 * Date: 01/12/17
 */
namespace ShoppingListBundle\Exception;

class ElementNotFoundException extends \Exception
{
    public function __construct($className, $elementName)
    {
        parent::__construct(sprintf("Element %s not found in %s", $elementName, $className));
    }
}