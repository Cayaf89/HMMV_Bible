<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Entity;

/**
 * Description of Magie
 *
 * @author Alexis
 */
class Magie {
    
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
     * @ManyToMany(targetEntity="App\Entity\Faction", inversedBy="magiesPreferees")
     * @JoinTable(name="MagieFaction")
     */
    private $factionsPreferees;
    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Sort", inversedBy="magie")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sorts;
}
