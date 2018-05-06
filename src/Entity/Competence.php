<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Description of Competence
 *
 * @author Alexi
 */
class Competence {
    private $id;
    private $capacites;
    private $heros;
    private $faction;
    private $nom;
    private $description;
    private $unique;
    
    public function __construct() {
        $this->capacites = new Collection();
        $this->heros     = new Collection();
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

    public function getUnique(): ?bool
    {
        return $this->unique;
    }

    public function setUnique(bool $unique): self
    {
        $this->unique = $unique;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFaction(): ?Faction
    {
        return $this->faction;
    }

    public function setFaction(?Faction $faction): self
    {
        $this->faction = $faction;

        return $this;
    }

    /**
     * @return Collection|Capacite[]
     */
    public function getCapacites(): Collection
    {
        return $this->capacites;
    }

    public function addCapacite(Capacite $capacite): self
    {
        if (!$this->capacites->contains($capacite)) {
            $this->capacites[] = $capacite;
        }

        return $this;
    }

    public function removeCapacite(Capacite $capacite): self
    {
        if ($this->capacites->contains($capacite)) {
            $this->capacites->removeElement($capacite);
        }

        return $this;
    }

    /**
     * @return Collection|Hero[]
     */
    public function getHeros(): Collection
    {
        return $this->heros;
    }

    public function addHero(Hero $hero): self
    {
        if (!$this->heros->contains($hero)) {
            $this->heros[] = $hero;
        }

        return $this;
    }

    public function removeHero(Hero $hero): self
    {
        if ($this->heros->contains($hero)) {
            $this->heros->removeElement($hero);
        }

        return $this;
    }
}
