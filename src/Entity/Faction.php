<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Description of Faction
 *
 * @author Alexi
 */
class Faction {
    private $id;
    private $competence;
    private $terrainBase;
    private $heros;
    private $magiesPreferees;
    private $specialisations;
    private $nomFaction;
    private $typeHero;
    private $description;
    
    public function __construct() {
        $this->heros           = new ArrayCollection();
        $this->magiesPreferees = new ArrayCollection();
        $this->specialisations = new ArrayCollection();
    }
}
