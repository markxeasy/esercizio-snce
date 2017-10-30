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

        //preparing the tags array to enable real time client side tag filtering
        $tags = new \stdClass;
        $counter = 0;
        foreach ($products as $product) {
            $currentid = $product->getID();
            $tags->$currentid = array();
            foreach ($product->getTags() as $tag) {
                array_push($tags->$currentid, $tag);
            }
            $counter++;
        }
        $productTags = json_encode($tags);

        $title = "Listato Prodotti";
        return $this->render(':products:list.html.twig', [
            'products' => $products,
            'title' => $title,
            'productTags' => $productTags,
        ]);
    }

    /**
     * @Route("/product/create", name="product-create")
     */
    public function createAction() {
        $product = new Product();
        $title = "Creazione Prodotto";
        $submitLabel = "crea";
        $action = "create";
        return $this->render(':products:form.html.twig', [
            'product' => $product,
            'title' => $title,
            'action' => $action,
            'submitLabel' => $submitLabel,
        ]);
    }

    /**
     * @Route("/product/{id}/edit", name="product-edit")
     */
    public function editAction($id) {
        $product = $this->getDoctrine()->getRepository("AppBundle:Product")->find($id);
        $title = "Modifica Prodotto " . $product->getName();
        $submitLabel = "modifica";
        $action = "edit";
        $tags = implode(',', $product->getTags());
        return $this->render(':products:form.html.twig', [
            'product' => $product,
            'title' => $title,
            'action' => $action,
            'submitLabel' => $submitLabel,
            'tags' => $tags,
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
