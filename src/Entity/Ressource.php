<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Ressource {
    
    private $id;
    private $artefacts;
    private $machineDeGuerre;
    private $nom;
    private $quantite;
    
    public function __construct() {
        $this->artefacts = new ArrayCollection();
        $this->machineDeGuerre = new ArrayCollection();
    }
}
