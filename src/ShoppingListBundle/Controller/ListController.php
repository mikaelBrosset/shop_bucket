<?php

namespace ShoppingListBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ShoppingListBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class ListController extends Controller
{
    /**
     * @Route("/", name="list_index")
     * @Method("GET")
     * @Template("list/listIndex.html.twig")
     */
    public function indexAction()
    {
        return [];
    }
    /**
     * @Route("/list_getlist", name="list_getList")
     * @Method("GET")
     */
    public function getList(Request $request) {
        if ($request->isXmlHttpRequest()) {

            $em = $this->getDoctrine()->getManager();
            $categories = $em->getRepository('ShoppingListBundle:Category')->getAllCategories();
            $products = $em->getRepository('ShoppingListBundle:Product')->getAllProducts();
            return new JsonResponse([
                'cats'  => $categories,
                'prods' => $products
            ]);

        } else {
            return new JsonResponse('false');
        }
    }

    /**
     * @Route("/list_filterlist", name="list_filterlist")
     * @Method("GET")
     */
    public function filterList(Request $request)
    {
        if ($request->isXmlHttpRequest() && null !== $request->query->get('catId')) {

            $em = $this->getDoctrine()->getManager();
            $categories = $em->getRepository('ShoppingListBundle:Category')->getAllCategories();

            if (is_numeric($request->query->get('catId'))) {
                $products = $em->getRepository('ShoppingListBundle:Product')->getProductsFromCategory((int)$request->query->get('catId'));

                return new JsonResponse([
                    'cats' => $categories,
                    'prods' => $products
                ]);

            } elseif ('tous' === $request->query->get('catId')) {

                $products = $em->getRepository('ShoppingListBundle:Product')->getAllProducts();
                return new JsonResponse([
                    'cats'  => $categories,
                    'prods' => $products
                ]);

            } else {
                return new JsonResponse('false');
            }

        } else {
            return new JsonResponse('false');
        }
    }

    /**
     * @Route("/list_addProductToBasket", name="list_addProductToBasket")
     * @Method("GET")
     */
    public function addProductToBasket(Request $request)
    {
        if ($request->isXmlHttpRequest() && null !== $request->query->get('prodId') && is_numeric($request->query->get('prodId'))) {

            $em = $this->getDoctrine()->getManager();
            $newProduct = $em->getRepository('ShoppingListBundle:Product')->getProductsById((int)$request->query->get('prodId'));

            return new JsonResponse([
                'prod' => $newProduct
            ]);

        } else {
            return new JsonResponse('false');
        }
    }
}
