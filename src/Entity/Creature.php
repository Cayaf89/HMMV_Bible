<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Creature {
    private $id;
    private $faction;
    private $batimentProducteur;
    private $capacites;
    private $pelotons;
    private $coutRessource;
    private $nom;
    private $description;
    private $attaque;
    private $defense;
    private $puissanceMagique;
    private $esprit;
    private $dommageMin;
    private $dommageMax;
    private $pdv;
    private $initiative;
    private $vitesse;
    private $tirs;
    private $mana;
    private $croissance;
    private $moral;
    private $chance;
    private $coutRessources;
    
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

    public function getDommageMin(): ?int
    {
        return $this->dommageMin;
    }

    public function setDommageMin(int $dommageMin): self
    {
        $this->dommageMin = $dommageMin;

        return $this;
    }

    public function getDommageMax(): ?int
    {
        return $this->dommageMax;
    }

    public function setDommageMax(int $dommageMax): self
    {
        $this->dommageMax = $dommageMax;

        return $this;
    }

    public function getPdv(): ?int
    {
        return $this->pdv;
    }

    public function setPdv(int $pdv): self
    {
        $this->pdv = $pdv;

        return $this;
    }

    public function getInitiative(): ?int
    {
        return $this->initiative;
    }

    public function setInitiative(int $initiative): self
    {
        $this->initiative = $initiative;

        return $this;
    }

    public function getVitesse(): ?int
    {
        return $this->vitesse;
    }

    public function setVitesse(int $vitesse): self
    {
        $this->vitesse = $vitesse;

        return $this;
    }

    public function getTirs(): ?int
    {
        return $this->tirs;
    }

    public function setTirs(int $tirs): self
    {
        $this->tirs = $tirs;

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

    public function getCroissance(): ?int
    {
        return $this->croissance;
    }

    public function setCroissance(int $croissance): self
    {
        $this->croissance = $croissance;

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

    public function getBatimentProducteur(): ?ArrayCollection
    {
        return $this->batimentProducteur;
    }

    public function addBatimentProducteur(Batiment $batimentProducteur): self
    {
        if (!$this->batimentProducteur->contains($batimentProducteur)) {
            $this->batimentProducteur[] = $batimentProducteur;
            $batimentProducteur->setCreaturesProduites($this);
        }

        return $this;
    }

    public function removeBatimentProducteur(Batiment $batimentProducteur): self
    {
        if ($this->batimentProducteur->contains($batimentProducteur)) {
            $this->batimentProducteur->removeElement($batimentProducteur);
            // set the owning side to null (unless already changed)
            if ($batimentProducteur->getCreaturesProduites() === $this) {
                $batimentProducteur->setCreaturesProduites(null);
            }
        }

        return $this;
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

    public function getPelotons(): ?Peloton
    {
        return $this->pelotons;
    }

    public function setPelotons(?Peloton $pelotons): self
    {
        $this->pelotons = $pelotons;

        return $this;
    }

    public function getCapacites(): ?ArrayCollection
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

    public function getCoutRessources(): ?ArrayCollection
    {
        return $this->coutRessources;
    }

    public function addCoutRessource(Ressource $coutRessource): self
    {
        if (!$this->coutRessources->contains($coutRessource)) {
            $this->coutRessources[] = $coutRessource;
        }

        return $this;
    }

    public function removeCoutRessource(Ressource $coutRessource): self
    {
        if ($this->coutRessources->contains($coutRessource)) {
            $this->coutRessources->removeElement($coutRessource);
        }

        return $this;
    }

    public function addFaction(Faction $faction): self
    {
        if (!$this->faction->contains($faction)) {
            $this->faction[] = $faction;
            $faction->set($this);
        }

        return $this;
    }

    public function removeFaction(Faction $faction): self
    {
        if ($this->faction->contains($faction)) {
            $this->faction->removeElement($faction);
            // set the owning side to null (unless already changed)
            if ($faction->get() === $this) {
                $faction->set(null);
            }
        }

        return $this;
    }
}
