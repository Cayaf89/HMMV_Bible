<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Peloton {
    private $id;
    private $heros;
    private $creature;
    private $quantite;

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreature(): ?ArrayCollection
    {
        return $this->creature;
    }

    public function addCreature(Creature $creature): self
    {
        if (!$this->creature->contains($creature)) {
            $this->creature[] = $creature;
            $creature->setPeletons($this);
        }

        return $this;
    }

    public function removeCreature(Creature $creature): self
    {
        if ($this->creature->contains($creature)) {
            $this->creature->removeElement($creature);
            // set the owning side to null (unless already changed)
            if ($creature->getPeletons() === $this) {
                $creature->setPeletons(null);
            }
        }

        return $this;
    }

    public function getHeros(): ?ArrayCollection
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
