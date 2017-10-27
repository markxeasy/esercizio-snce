<?php 

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Tag which relates to the 'tag' table in the database 
 * @package AppBundle\Entity
 * 
 * 
 * @ORM\Entity
 * @ORM\Table(name="tag")
 */

 class Tag {
     /**
      * @ORM\Column(type="integer")
      * @ORM\Id
      * @ORM\GeneratedValue(strategy="AUTO")
      */
      protected $tagID;

      /**
      * @ORM\Column(type="string")
      */
      protected $name;
 }