<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Description of Terrain
 *
 * @author Alexi
 */
class Terrain {
    private $id;
    private $factions;
    private $coutDeplacement;
    private $nom;
    
    public function __construct() {
        $this->factions = new ArrayCollection();
    }
}
