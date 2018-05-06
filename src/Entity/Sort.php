<?php

namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Sort {
    
    private $id;
    private $nom;
    private $description;
    private $magie;
    private $coutMana;
    private $heros;
    
    public function __construct() {
        $this->heros = new Collection();
        $this->magie = new Collection();
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

    public function getCoutMana(): ?int
    {
        return $this->coutMana;
    }

    public function setCoutMana(int $coutMana): self
    {
        $this->coutMana = $coutMana;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Magie[]
     */
    public function getMagie(): Collection
    {
        return $this->magie;
    }

    public function addMagie(Magie $magie): self
    {
        if (!$this->magie->contains($magie)) {
            $this->magie[] = $magie;
            $magie->setSorts($this);
        }

        return $this;
    }

    public function removeMagie(Magie $magie): self
    {
        if ($this->magie->contains($magie)) {
            $this->magie->removeElement($magie);
            // set the owning side to null (unless already changed)
            if ($magie->getSorts() === $this) {
                $magie->setSorts(null);
            }
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
