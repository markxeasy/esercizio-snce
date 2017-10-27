<?php 

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Product which relates to the 'product' table in the database 
 * @package AppBundle\Entity
 * 
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
 }