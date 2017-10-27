<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends Controller
{
    /**
     * @Route("/product/list", name="product-list")
     */
    public function listAction()
    {
        $products = $this->getDoctrine()->getRepository("AppBundle:Product")->findAll();
        // replace this example code with whatever you need
        return $this->render(':products:index.html.twig', [
            'products' => $products,
        ]);
    }
}
