<?php

namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;

class Ville {
    
    private $id;
    private $nom;
    private $description;
    private $faction;
    private $specialisation;
    private $batiments;
    
    public function __construct() {
        $this->batiments = new ArrayCollection();
        $this->faction = new ArrayCollection();
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return ArrayCollection|Faction[]
     */
    public function getFaction(): ArrayCollection
    {
        return $this->faction;
    }

    public function addFaction(Faction $faction): self
    {
        if (!$this->faction->contains($faction)) {
            $this->faction[] = $faction;
            $faction->setVilles($this);
        }

        return $this;
    }

    public function removeFaction(Faction $faction): self
    {
        if ($this->faction->contains($faction)) {
            $this->faction->removeElement($faction);
            // set the owning side to null (unless already changed)
            if ($faction->getVilles() === $this) {
                $faction->setVilles(null);
            }
        }

        return $this;
    }

    public function getBatiments(): ?Batiment
    {
        return $this->batiments;
    }

    public function setBatiments(?Batiment $batiments): self
    {
        $this->batiments = $batiments;

        return $this;
    }
    
}
