<?php

namespace App\Entity;

class Capacite {
    
    private $id;
    private $competenceRequise;
    private $capacitesRequises;
    private $nom;
    private $description;
    
    public function __construct() {
        $this->capacitesRequises = new ArrayCollection();
    }
}
