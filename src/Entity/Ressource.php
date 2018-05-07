<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Ressource {
    private $id;
    private $artefacts;
    private $creatures;
    private $batimentsDebloques;
    private $machinesDeGuerre;
    private $nom;
    private $quantite;

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

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

    public function getArtefacts(): ?Artefact
    {
        return $this->artefacts;
    }

    public function setArtefacts(?Artefact $artefacts): self
    {
        $this->artefacts = $artefacts;

        return $this;
    }

    public function getMachinesDeGuerre(): ?MachineDeGuerre
    {
        return $this->machinesDeGuerre;
    }

    public function setMachinesDeGuerre(?MachineDeGuerre $machinesDeGuerre): self
    {
        $this->machinesDeGuerre = $machinesDeGuerre;

        return $this;
    }

    public function getCreatures(): ?ArrayCollection
    {
        return $this->creatures;
    }

    public function addCreature(Creature $creature): self
    {
        if (!$this->creatures->contains($creature)) {
            $this->creatures[] = $creature;
        }

        return $this;
    }

    public function removeCreature(Creature $creature): self
    {
        if ($this->creatures->contains($creature)) {
            $this->creatures->removeElement($creature);
        }

        return $this;
    }

    public function getBatiments(): ?ArrayCollection
    {
        return $this->batiments;
    }

    public function addBatiment(Batiment $batiment): self
    {
        if (!$this->batiments->contains($batiment)) {
            $this->batiments[] = $batiment;
        }

        return $this;
    }

    public function removeBatiment(Batiment $batiment): self
    {
        if ($this->batiments->contains($batiment)) {
            $this->batiments->removeElement($batiment);
        }

        return $this;
    }

    public function getBatimentsDebloques(): ?ArrayCollection
    {
        return $this->batimentsDebloques;
    }

    public function addBatimentsDebloque(Batiment $batimentsDebloque): self
    {
        if (!$this->batimentsDebloques->contains($batimentsDebloque)) {
            $this->batimentsDebloques[] = $batimentsDebloque;
        }

        return $this;
    }

    public function removeBatimentsDebloque(Batiment $batimentsDebloque): self
    {
        if ($this->batimentsDebloques->contains($batimentsDebloque)) {
            $this->batimentsDebloques->removeElement($batimentsDebloque);
        }

        return $this;
    }
}
