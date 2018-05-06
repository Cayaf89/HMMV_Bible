<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Artefact {
    
    private $id;
    private $nom;
    private $description;
    private $batimentDebloque;
    private $emplacement;
    private $importance;
    private $panoplie;
    private $coutRessource;

    public function __construct()
    {
        $this->panoplie      = new ArrayCollection();
        $this->coutRessource = new ArrayCollection();
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

    public function getEmplacement(): ?string
    {
        return $this->emplacement;
    }

    public function setEmplacement(string $emplacement): self
    {
        $this->emplacement = $emplacement;

        return $this;
    }

    public function getImportance(): ?string
    {
        return $this->importance;
    }

    public function setImportance(string $importance): self
    {
        $this->importance = $importance;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return ArrayCollection|Panoplie[]
     */
    public function getPanoplie(): ArrayCollection
    {
        return $this->panoplie;
    }

    public function addPanoplie(Panoplie $panoplie): self
    {
        if (!$this->panoplie->contains($panoplie)) {
            $this->panoplie[] = $panoplie;
            $panoplie->setArtefacts($this);
        }

        return $this;
    }

    public function removePanoplie(Panoplie $panoplie): self
    {
        if ($this->panoplie->contains($panoplie)) {
            $this->panoplie->removeElement($panoplie);
            // set the owning side to null (unless already changed)
            if ($panoplie->getArtefacts() === $this) {
                $panoplie->setArtefacts(null);
            }
        }

        return $this;
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
            $coutRessource->setArtefacts($this);
        }

        return $this;
    }

    public function removeCoutRessource(Ressource $coutRessource): self
    {
        if ($this->coutRessource->contains($coutRessource)) {
            $this->coutRessource->removeElement($coutRessource);
            // set the owning side to null (unless already changed)
            if ($coutRessource->getArtefacts() === $this) {
                $coutRessource->setArtefacts(null);
            }
        }

        return $this;
    }

    public function getBatimentDebloque(): ?Batiment
    {
        return $this->batimentDebloque;
    }

    public function setBatimentDebloque(?Batiment $batimentDebloque): self
    {
        $this->batimentDebloque = $batimentDebloque;

        return $this;
    }
    
}
