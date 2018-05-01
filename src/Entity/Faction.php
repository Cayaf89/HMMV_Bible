<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Entity;

/**
 * Description of Faction
 *
 * @author Alexis
 */
class Faction {
    
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
     * @ORM\Column(type="boolean")
     */
    private $capaciteCreature;
    
    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Competence", mappedBy="faction")
     */
    private $competence;
    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Hero", inversedBy="faction")
     * @ORM\JoinColumn(nullable=false)
     */
    private $heros;
    
    /**
     * @ManyToMany(targetEntity="App\Entity\Magie", inversedBy="factionsPreferees")
     * @JoinTable(name="MagieFaction")
     */
    private $magiesPreferees;
    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Specialisation", inversedBy="faction")
     * @ORM\JoinColumn(nullable=true)
     */
    private $specialisations;
}
