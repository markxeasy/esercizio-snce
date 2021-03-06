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
     * @Route("/", name="homepage")
     */
    public function homeAction() {
        return $this->redirectToRoute('product-list');
    }

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
        $action = "insert";
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
        $action = "update";
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
        if(file_exists($product->getImagePath()) && $product->getImage() != null) {
            unlink($product->getImagePath());
        }
        $doctrineManager->remove($product);
        $doctrineManager->flush();
        return $this->redirectToRoute('product-list');
    }

    /**
     * @Route("/product/form/{action}", name="product-form-submit")
     */
    public function submitAction($action) {
        //if user selected an image upload it to the uploades/image folder
        if ($_FILES['image']['size'] > 0) {
            $uploaddir = 'upload/images/';
            $counter = 1;
            //prepare to handle if the same image is used for more products
            $extensionStart = strpos(basename($_FILES['image']['name']), '.');
            $imageName = substr(basename($_FILES['image']['name']), 0, $extensionStart);
            $imageExtension = strrchr(basename($_FILES['image']['name']), '.');
            do {
                $image = $imageName . strval($counter) . $imageExtension;
                $uploadfile = $uploaddir . $image;
                $counter++;
            } while (file_exists($uploadfile));
            //move the file to the upload/images/ directory
            move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile);
        } else {
            $image = null;
        }
        //create a new Product object with the user's input data
        $product = new Product($_POST["name"], $_POST["description"], $image, $_POST["tags"]);
        if($action === 'insert') {
            return $this->insertAction($product);
        } else if ($action === 'update') {
            $deleteImage = ($_POST['deleteImage'] === "true");
            return $this->updateAction($product, $_POST["productID"], $deleteImage);
        } else {
            return false;
        }
    }

    public function insertAction($product) {
        $doctrineManager = $this->getDoctrine()->getManager();
        $doctrineManager->persist($product);
        $doctrineManager->flush();
        return $this->redirectToRoute('product-list');
    }

    public function updateAction($newProduct, $id, $deleteImage) {
        $doctrineManager = $this->getDoctrine()->getManager();
        $product = $this->getDoctrine()->getRepository("AppBundle:Product")->find($id);
        //Check if the new image is different, if it is delete the old one from the server
        if ($deleteImage || ($product->getImage() != $newProduct->getImage() && $newProduct->getImage() != null) && $product->getImage() != null) {
            unlink($product->getImagePath());
        }
        $product->setName($newProduct->getName());
        $product->setDescription($newProduct->getDescription());
        if ($newProduct->getImage() != null) {
            $product->setImage($newProduct->getImage());            
        } else if($deleteImage) {
            $product->setImage(null);
        }
        $product->setTags(implode(",", $newProduct->getTags()));
        $doctrineManager->merge($product);
        $doctrineManager->flush();
        return $this->redirectToRoute('product-list');
    }
}
