<?php

namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Specialisation {
    
    private $id;
    private $nom;
    private $description;
    private $factionsHero;
    private $factionVille;
    private $heros;
    
    public function __construct() {
        $this->heros        = new Collection();
        $this->factionsHero = new Collection();
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

    public function getFactionVille(): ?Faction
    {
        return $this->factionVille;
    }

    public function setFactionVille(?Faction $factionVille): self
    {
        $this->factionVille = $factionVille;

        // set (or unset) the owning side of the relation if necessary
        $newSpecialisationVille = $factionVille === null ? null : $this;
        if ($newSpecialisationVille !== $factionVille->getSpecialisationVille()) {
            $factionVille->setSpecialisationVille($newSpecialisationVille);
        }

        return $this;
    }

    public function getHeros(): ?Hero
    {
        return $this->heros;
    }

    public function setHeros(?Hero $heros): self
    {
        $this->heros = $heros;

        return $this;
    }

    /**
     * @return Collection|Faction[]
     */
    public function getFactionsHero(): Collection
    {
        return $this->factionsHero;
    }

    public function addFactionsHero(Faction $factionsHero): self
    {
        if (!$this->factionsHero->contains($factionsHero)) {
            $this->factionsHero[] = $factionsHero;
            $factionsHero->addSpecialisationsHero($this);
        }

        return $this;
    }

    public function removeFactionsHero(Faction $factionsHero): self
    {
        if ($this->factionsHero->contains($factionsHero)) {
            $this->factionsHero->removeElement($factionsHero);
            $factionsHero->removeSpecialisationsHero($this);
        }

        return $this;
    }
}
