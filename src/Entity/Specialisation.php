<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Entity;

/**
 * Description of Specialisation
 *
 * @author Alexi
 */
class Specialisation {
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
        
    /**
     * @ORM\Column(type="string")
     */
    private $nom;
    
    /**
     * @ORM\Column(type="text")
     */
    private $description;
    
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Hero", mappedBy="specialisation")
     * @ORM\JoinColumn(nullable=true)
     */
    private $hero;
    
    /**
     * @OneToOne(targetEntity="App\Entity\Ville", mappedBy="specialisation")
     * @ORM\JoinColumn(nullable=true)
     */
    private $ville;
    
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Faction", inversedBy="specialisations")
     * @ORM\JoinColumn(nullable=true)
     */
    private $faction;
}
