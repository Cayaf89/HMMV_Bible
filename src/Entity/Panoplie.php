<?php

namespace App\Entity;

class Panoplie {
    
    private $id;
    private $artefacts;
    private $nom;
    private $description;
    
    public function __construct() {
        $this->artefacts = new ArrayCollection();
    }
    
}
