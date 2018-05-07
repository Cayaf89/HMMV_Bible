<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Hero {
    private $id;
    private $faction;
    private $capaciteHero;
    private $competences;
    private $capacites;
    private $specialisation;
    private $armee;
    private $sortsDepart;
    private $nom;
    private $description;
    private $attaque;
    private $defense;
    private $puissanceMagique;
    private $esprit;
    private $mana;
    private $moral;
    private $chance;

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

    public function getAttaque(): ?int
    {
        return $this->attaque;
    }

    public function setAttaque(int $attaque): self
    {
        $this->attaque = $attaque;

        return $this;
    }

    public function getDefense(): ?int
    {
        return $this->defense;
    }

    public function setDefense(int $defense): self
    {
        $this->defense = $defense;

        return $this;
    }

    public function getPuissanceMagique(): ?int
    {
        return $this->puissanceMagique;
    }

    public function setPuissanceMagique(int $puissanceMagique): self
    {
        $this->puissanceMagique = $puissanceMagique;

        return $this;
    }

    public function getEsprit(): ?int
    {
        return $this->esprit;
    }

    public function setEsprit(int $esprit): self
    {
        $this->esprit = $esprit;

        return $this;
    }

    public function getMana(): ?int
    {
        return $this->mana;
    }

    public function setMana(int $mana): self
    {
        $this->mana = $mana;

        return $this;
    }

    public function getMoral(): ?int
    {
        return $this->moral;
    }

    public function setMoral(int $moral): self
    {
        $this->moral = $moral;

        return $this;
    }

    public function getChance(): ?int
    {
        return $this->chance;
    }

    public function setChance(int $chance): self
    {
        $this->chance = $chance;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCapaciteHero(): ?CapaciteHero
    {
        return $this->capaciteHero;
    }

    public function setCapaciteHero(?CapaciteHero $capaciteHero): self
    {
        $this->capaciteHero = $capaciteHero;

        return $this;
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
            $faction->setHeros($this);
        }

        return $this;
    }

    public function removeFaction(Faction $faction): self
    {
        if ($this->faction->contains($faction)) {
            $this->faction->removeElement($faction);
            // set the owning side to null (unless already changed)
            if ($faction->getHeros() === $this) {
                $faction->setHeros(null);
            }
        }

        return $this;
    }

    /**
     * @return ArrayCollection|Specialisation[]
     */
    public function getSpecialisation(): ArrayCollection
    {
        return $this->specialisation;
    }

    public function addSpecialisation(Specialisation $specialisation): self
    {
        if (!$this->specialisation->contains($specialisation)) {
            $this->specialisation[] = $specialisation;
            $specialisation->setHeros($this);
        }

        return $this;
    }

    public function removeSpecialisation(Specialisation $specialisation): self
    {
        if ($this->specialisation->contains($specialisation)) {
            $this->specialisation->removeElement($specialisation);
            // set the owning side to null (unless already changed)
            if ($specialisation->getHeros() === $this) {
                $specialisation->setHeros(null);
            }
        }

        return $this;
    }

    /**
     * @return ArrayCollection|Competence[]
     */
    public function getCompetences(): ArrayCollection
    {
        return $this->competences;
    }

    public function addCompetence(Competence $competence): self
    {
        if (!$this->competences->contains($competence)) {
            $this->competences[] = $competence;
        }

        return $this;
    }

    public function removeCompetence(Competence $competence): self
    {
        if ($this->competences->contains($competence)) {
            $this->competences->removeElement($competence);
        }

        return $this;
    }

    /**
     * @return ArrayCollection|Capacite[]
     */
    public function getCapacites(): ArrayCollection
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
     * @return ArrayCollection|Peloton[]
     */
    public function getArmee(): ArrayCollection
    {
        return $this->armee;
    }

    public function addArmee(Peloton $armee): self
    {
        if (!$this->armee->contains($armee)) {
            $this->armee[] = $armee;
        }

        return $this;
    }

    public function removeArmee(Peloton $armee): self
    {
        if ($this->armee->contains($armee)) {
            $this->armee->removeElement($armee);
        }

        return $this;
    }

    /**
     * @return ArrayCollection|Sort[]
     */
    public function getSortsDepart(): ArrayCollection
    {
        return $this->sortsDepart;
    }

    public function addSortsDepart(Sort $sortsDepart): self
    {
        if (!$this->sortsDepart->contains($sortsDepart)) {
            $this->sortsDepart[] = $sortsDepart;
        }

        return $this;
    }

    public function removeSortsDepart(Sort $sortsDepart): self
    {
        if ($this->sortsDepart->contains($sortsDepart)) {
            $this->sortsDepart->removeElement($sortsDepart);
        }

        return $this;
    }
}
