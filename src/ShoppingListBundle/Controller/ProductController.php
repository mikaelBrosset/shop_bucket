<?php

namespace ShoppingListBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ShoppingListBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class ProductController extends Controller
{
    /**
     * @Route("/add", name="add_product")
     * @Template("list/newProduct.html.twig")
     */
    public function addProductAction(Request $request)
    {
        $p = new Product();
        $form = $this->createForm('ShoppingListBundle\Form\ProductType', $p);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($p);
            $em->flush();

            $em = $this->getDoctrine()->getManager();
            $categories = $em->getRepository('ShoppingListBundle:Category')->findAll();
            $cats = ['cats' => $categories];

            return $this->redirectToRoute('list_index', array('cats' => $cats));
        }

        return [
            'form' => $form->createView(),
        ];
    }
}
