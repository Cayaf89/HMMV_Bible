<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Entity;

/**
 * Description of Sort
 *
 * @author Alexis
 */
class Sort {
    
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
     * @ORM\Column(type="integer")
     */
    private $coutMana;
    
    /**
     * @ORM\Column(type="text")
     */
    private $description;
    
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Magie", mappedBy="sorts")
     */
    private $magie;
}
