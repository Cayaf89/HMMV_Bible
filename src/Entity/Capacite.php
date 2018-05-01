<?php

namespace App\Entity;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Capacite
 *
 * @author Alexis
 */
class Capacite {
    
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
     * @ORM\OneToMany(targetEntity="App\Entity\Faction", mappedBy="capacites")
     */
    private $factionRequise;
    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Competence", inversedBy="capacites")
     * @ORM\JoinColumn(nullable=false)
     */
    private $competencesRequises;
}
