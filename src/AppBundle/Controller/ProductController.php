<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Product;
use AppBundle\Entity\Tag;

class ProductController extends Controller
{
    /**
     * @Route("/product/list", name="product-list")
     */
    public function listAction() {
        $products = $this->getDoctrine()->getRepository("AppBundle:Product")->findBy(array(), array('creationDate' => 'ASC'));
        $title = "Listato Prodotti";
        // replace this example code with whatever you need
        return $this->render(':products:list.html.twig', [
            'products' => $products,
            'title' => $title,
        ]);
    }

    /**
     * @Route("/product/create", name="product-create")
     */
    public function createAction() {
        $product = new Product();
        $title = "Creazione Prodotto";
        $action = "create";
        // replace this example code with whatever you need
        return $this->render(':products:form.html.twig', [
            'product' => $product,
            'title' => $title,
            'action' => $action,
        ]);
    }

    /**
     * @Route("/product/{id}/edit", name="product-edit")
     */
    public function editAction($id) {
        $product = $this->getDoctrine()->getRepository("AppBundle:Product")->find($id);
        $title = "Modifica Prodotto " . $product->getName();
        $action = "edit";
        // replace this example code with whatever you need
        return $this->render(':products:form.html.twig', [
            'product' => $product,
            'title' => $title,
            'action' => $action,
        ]);
    }

    /**
     * @Route("/product/{id}/delete", name="product-delete")
     */
    public function deleteAction($id) {
        $doctrineManager = $this->getDoctrine()->getManager();
        $product = $doctrineManager->getReference('AppBundle:Product', $id);
        $doctrineManager->remove($product);
        $doctrineManager->flush();
        return $this->listAction();
    }
}
