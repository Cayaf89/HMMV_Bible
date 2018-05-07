<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Faction {
    private $id;
    private $competence;
    private $terrain;
    private $heros;
    private $villes;
    private $magiesPreferees;
    private $specialisationsHero;
    private $specialisationVille;
    private $creatures;
    private $nomFaction;
    private $typeHero;
    private $description;
    
    public function getNomFaction(): ?string
    {
        return $this->nomFaction;
    }

    public function setNomFaction(string $nomFaction): self
    {
        $this->nomFaction = $nomFaction;

        return $this;
    }

    public function getTypeHero(): ?string
    {
        return $this->typeHero;
    }

    public function setTypeHero(string $typeHero): self
    {
        $this->typeHero = $typeHero;

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

    public function getCompetence(): ?Competence
    {
        return $this->competence;
    }

    public function setCompetence(?Competence $competence): self
    {
        $this->competence = $competence;

        // set (or unset) the owning side of the relation if necessary
        $newFaction = $competence === null ? null : $this;
        if ($newFaction !== $competence->getFaction()) {
            $competence->setFaction($newFaction);
        }

        return $this;
    }

    public function getSpecialisationVille(): ?Specialisation
    {
        return $this->specialisationVille;
    }

    public function setSpecialisationVille(?Specialisation $specialisationVille): self
    {
        $this->specialisationVille = $specialisationVille;

        return $this;
    }

    /**
     * @return ArrayCollection|Terrain[]
     */
    public function getTerrain(): ArrayCollection
    {
        return $this->terrain;
    }

    public function addTerrain(Terrain $terrain): self
    {
        if (!$this->terrain->contains($terrain)) {
            $this->terrain[] = $terrain;
            $terrain->setFactions($this);
        }

        return $this;
    }

    public function removeTerrain(Terrain $terrain): self
    {
        if ($this->terrain->contains($terrain)) {
            $this->terrain->removeElement($terrain);
            // set the owning side to null (unless already changed)
            if ($terrain->getFactions() === $this) {
                $terrain->setFactions(null);
            }
        }

        return $this;
    }

    /**
     * @return ArrayCollection|Hero[]
     */
    public function getHeros(): ArrayCollection
    {
        return $this->heros;
    }

    public function addHero(Hero $hero): self
    {
        if (!$this->heros->contains($hero)) {
            $this->heros[] = $hero;
            $hero->setFaction($this);
        }

        return $this;
    }

    public function removeHero(Hero $hero): self
    {
        if ($this->heros->contains($hero)) {
            $this->heros->removeElement($hero);
            // set the owning side to null (unless already changed)
            if ($hero->getFaction() === $this) {
                $hero->setFaction(null);
            }
        }

        return $this;
    }

    /**
     * @return ArrayCollection|Creature[]
     */
    public function getCreatures(): ArrayCollection
    {
        return $this->creatures;
    }

    public function addCreature(Creature $creature): self
    {
        if (!$this->creatures->contains($creature)) {
            $this->creatures[] = $creature;
            $creature->setFaction($this);
        }

        return $this;
    }

    public function removeCreature(Creature $creature): self
    {
        if ($this->creatures->contains($creature)) {
            $this->creatures->removeElement($creature);
            // set the owning side to null (unless already changed)
            if ($creature->getFaction() === $this) {
                $creature->setFaction(null);
            }
        }

        return $this;
    }

    public function getVilles(): ?Ville
    {
        return $this->villes;
    }

    public function setVilles(?Ville $villes): self
    {
        $this->villes = $villes;

        return $this;
    }

    /**
     * @return ArrayCollection|Magie[]
     */
    public function getMagiesPreferees(): ArrayCollection
    {
        return $this->magiesPreferees;
    }

    public function addMagiesPreferee(Magie $magiesPreferee): self
    {
        if (!$this->magiesPreferees->contains($magiesPreferee)) {
            $this->magiesPreferees[] = $magiesPreferee;
        }

        return $this;
    }

    public function removeMagiesPreferee(Magie $magiesPreferee): self
    {
        if ($this->magiesPreferees->contains($magiesPreferee)) {
            $this->magiesPreferees->removeElement($magiesPreferee);
        }

        return $this;
    }

    /**
     * @return ArrayCollection|Specialisation[]
     */
    public function getSpecialisationsHero(): ArrayCollection
    {
        return $this->specialisationsHero;
    }

    public function addSpecialisationsHero(Specialisation $specialisationsHero): self
    {
        if (!$this->specialisationsHero->contains($specialisationsHero)) {
            $this->specialisationsHero[] = $specialisationsHero;
        }

        return $this;
    }

    public function removeSpecialisationsHero(Specialisation $specialisationsHero): self
    {
        if ($this->specialisationsHero->contains($specialisationsHero)) {
            $this->specialisationsHero->removeElement($specialisationsHero);
        }

        return $this;
    }

    public function setHeros(?Hero $heros): self
    {
        $this->heros = $heros;

        return $this;
    }

    public function setCreatures(?Creature $creatures): self
    {
        $this->creatures = $creatures;

        return $this;
    }
}
