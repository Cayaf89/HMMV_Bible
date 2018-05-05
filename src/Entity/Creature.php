<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Creature {
    
    private $id;
    private $faction;
    private $capacites;
    private $coutRessource;
    private $nom;
    private $description;
    private $attaque;
    private $defense;
    private $puissanceMagique;
    private $esprit;
    private $dommageMin;
    private $dommageMax;
    private $pdv;
    private $initiative;
    private $vitesse;
    private $tirs;
    private $mana;
    private $croissance;
    private $moral;
    private $chance;
    
    public function __construct() {
        $this->faction = new ArrayCollection();
        $this->capacites = new ArrayCollection();
        $this->coutRessource = new ArrayCollection();
    }
}
