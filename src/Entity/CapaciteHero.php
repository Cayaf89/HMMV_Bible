<?php

namespace App\Entity;

class CapaciteHero {
    
    private $id;
    private $hero;
    private $nom;
    private $description;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHero(): ?Hero
    {
        return $this->hero;
    }

    public function setHero(?Hero $hero): self
    {
        $this->hero = $hero;

        // set (or unset) the owning side of the relation if necessary
        $newCapaciteHero = $hero === null ? null : $this;
        if ($newCapaciteHero !== $hero->getCapaciteHero()) {
            $hero->setCapaciteHero($newCapaciteHero);
        }

        return $this;
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
    
}
