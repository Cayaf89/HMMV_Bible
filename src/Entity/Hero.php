<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;


/**
 * Description of Hero
 *
 * @author Alexis
 */
class Hero {
    private $id;
    private $faction;
    private $capaciteHero;
    private $competences;
    private $capacites;
    private $armee;
    private $sortsDepart;
    private $nom;
    private $description;
    private $attaque;
    private $defense;
    private $puissanceMagique;
    private $esprit;
    private $mana;
    private $moral;
    private $chance;
    
    public function __construct()
    {
        $this->competences  = new ArrayCollection();
        $this->capacites    = new ArrayCollection();
        $this->armee        = new ArrayCollection();
        $this->sortsDepart  = new ArrayCollection();
    }
}
