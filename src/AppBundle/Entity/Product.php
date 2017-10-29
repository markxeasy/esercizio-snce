<?php 

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


//constant to have the path to where the product images are uploaded
const UPLOAD_IMAGES_PATH = 'upload/images/';

/**
 * Class Product which relates to the 'product' table in the database 
 * @package AppBundle\Entity
 * 
 * @ORM\Entity
 * @ORM\Table(name="product")
 */

 class Product {
    /**
     * @ORM\Column(type="integer")
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    */
    protected $productID;

    /**
     * @ORM\Column(type="string")
    */
    protected $name;

    /**
     * @ORM\Column(type="string")
    */
    protected $description;

    /**
     * @ORM\Column(type="string")
    */
    protected $image;

    /**
     * @ORM\Column(type="string")
    */
    protected $tags;

    /**
     * @ORM\Column(type="datetime")
    */
    protected $creationDate;

    /**
     * @return mixed
     */
    public function getID() {
        return $this->productID;
    }

    /**
     * @return mixed
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Product
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return Product
     */
    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getImage() {
        return UPLOAD_IMAGES_PATH . $this->image;
    }

    /**
     * @param mixed $image
     * @return Product
     */
    public function setImage($image) {
        $this->image = $image;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTags() {
        return explode(',', $this->tags);
    }

    /**
     * @param mixed $tags
     * @return Product
     */
    public function setTags($tags) {
        $this->tags = $tags;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreationDate() {
        return $this->creationDate;
    }

    /**
     * @param mixed $creationDate
     * @return Product
     */
    public function setCreationDate($creationDate) {
        $this->creationDate = $creationDate;
        return $this;
    }
 }