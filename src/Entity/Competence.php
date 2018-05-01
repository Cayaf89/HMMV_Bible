<?php

namespace App\Entity;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Doctrine\Common\Collections\Collection as Collection;

/**
 * Description of Competence
 *
 * @author Alexis
 */
class Competence {
    
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;
    
    /**
     * @ORM\Column(type="text")
     */
    private $description;
    
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Competence", mappedBy="CompetencesRequises")
     */
    private $capacites;
    
    
    /**
     * @return \Int
     */
    public function getId(): Int {
        return $this->id;
    }

    /**
     * @return \String
     */
    public function getName(): String {
        return $this->name;
    }

    /**
     * @return \String
     */
    public function getDescription(): String {
        return $this->description;
    }

    /**
     * @param Int $id
     * @return $this
     */
    public function setId(Int $id) {
        $this->id = $id;
        return $this;
    }

    /**
     * @param String $name
     * @return $this
     */
    public function setName(String $name) {
        $this->name = $name;
        return $this;
    }

    /**
     * @param String $description
     * @return $this
     */
    public function setDescription(String $description) {
        $this->description = $description;
        return $this;
    }
    
    /**
     * @return Collection|Capacite[]
     */
    public function getCapacites(): Collection {
        return $this->capacites;
    }

    /**
     * @param Collection $capacites
     * @return $this
     */
    public function setCapacites(Collection $capacites) {
        $this->capacites = $capacites;
        return $this;
    }


}
