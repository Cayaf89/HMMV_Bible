<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class MachineDeGuerre {
    private $id;
    private $coutRessource;
    private $nom;
    private $description;

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

    /**
     * @return ArrayCollection|Ressource[]
     */
    public function getCoutRessource(): ArrayCollection
    {
        return $this->coutRessource;
    }

    public function addCoutRessource(Ressource $coutRessource): self
    {
        if (!$this->coutRessource->contains($coutRessource)) {
            $this->coutRessource[] = $coutRessource;
            $coutRessource->setMachinesDeGuerre($this);
        }

        return $this;
    }

    public function removeCoutRessource(Ressource $coutRessource): self
    {
        if ($this->coutRessource->contains($coutRessource)) {
            $this->coutRessource->removeElement($coutRessource);
            // set the owning side to null (unless already changed)
            if ($coutRessource->getMachinesDeGuerre() === $this) {
                $coutRessource->setMachinesDeGuerre(null);
            }
        }

        return $this;
    }
    
}
