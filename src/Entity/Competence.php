<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Description of Competence
 *
 * @author Alexi
 */
class Competence {
    private $id;
    private $capacites;
    private $nom;
    private $description;
    private $unique;
    
    public function __construct() {
        $this->capacites = new ArrayCollection();
    }
}
