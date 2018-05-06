<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Capacite {
    
    private $id;
    private $competenceRequise;
    private $capacitesRequises;
    private $capacitesDebloques;
    private $heros;
    private $nom;
    private $description;
    
    public function __construct() 
    {
        $this->capacitesRequises = new Collection();
        $this->heros             = new Collection();
        $this->competenceRequise = new Collection();
        $this->capacitesDebloques = new ArrayCollection();
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
        return $this->description ;
    }

    public function setDescription(string $description ): self
    {
        $this->description  = $description ;

        return $this;
    }

    /**
     * @return Collection|Competence[]
     */
    public function getCompetenceRequise(): Collection
    {
        return $this->competenceRequise;
    }

    public function addCompetenceRequise(Competence $competenceRequise): self
    {
        if (!$this->competenceRequise->contains($competenceRequise)) {
            $this->competenceRequise[] = $competenceRequise;
            $competenceRequise->setCapacites($this);
        }

        return $this;
    }

    public function removeCompetenceRequise(Competence $competenceRequise): self
    {
        if ($this->competenceRequise->contains($competenceRequise)) {
            $this->competenceRequise->removeElement($competenceRequise);
            // set the owning side to null (unless already changed)
            if ($competenceRequise->getCapacites() === $this) {
                $competenceRequise->setCapacites(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Capacite[]
     */
    public function getCapacitesRequises(): Collection
    {
        return $this->capacitesRequises;
    }

    public function addCapacitesRequise(Capacite $capacitesRequise): self
    {
        if (!$this->capacitesRequises->contains($capacitesRequise)) {
            $this->capacitesRequises[] = $capacitesRequise;
        }

        return $this;
    }

    public function removeCapacitesRequise(Capacite $capacitesRequise): self
    {
        if ($this->capacitesRequises->contains($capacitesRequise)) {
            $this->capacitesRequises->removeElement($capacitesRequise);
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

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Capacite[]
     */
    public function getCapacitesDebloques(): Collection
    {
        return $this->capacitesDebloques;
    }

    public function addCapacitesDebloque(Capacite $capacitesDebloque): self
    {
        if (!$this->capacitesDebloques->contains($capacitesDebloque)) {
            $this->capacitesDebloques[] = $capacitesDebloque;
        }

        return $this;
    }

    public function removeCapacitesDebloque(Capacite $capacitesDebloque): self
    {
        if ($this->capacitesDebloques->contains($capacitesDebloque)) {
            $this->capacitesDebloques->removeElement($capacitesDebloque);
        }

        return $this;
    }
}
