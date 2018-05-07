<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Batiment {
    private $id;
    private $nom;
    private $description;
    private $batimentNecessaire;
    private $batimentDebloque;
    private $artefactNecessaire;
    private $niveauVille;
    private $ville;
    private $creaturesProduites;
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

    public function getNiveauVille(): ?int
    {
        return $this->niveauVille;
    }

    public function setNiveauVille(int $niveauVille): self
    {
        $this->niveauVille = $niveauVille;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBatimentNecessaire(): ?self
    {
        return $this->batimentNecessaire;
    }

    public function setBatimentNecessaire(?self $batimentNecessaire): self
    {
        $this->batimentNecessaire = $batimentNecessaire;

        return $this;
    }

    public function getArtefactNecessaire(): ?Artefact
    {
        return $this->artefactNecessaire;
    }

    public function setArtefactNecessaire(?Artefact $artefactNecessaire): self
    {
        $this->artefactNecessaire = $artefactNecessaire;

        return $this;
    }

    public function getVille(): ?ArrayCollection
    {
        return $this->ville;
    }

    public function addVille(Ville $ville): self
    {
        if (!$this->ville->contains($ville)) {
            $this->ville[] = $ville;
            $ville->setBatiments($this);
        }

        return $this;
    }

    public function removeVille(Ville $ville): self
    {
        if ($this->ville->contains($ville)) {
            $this->ville->removeElement($ville);
            // set the owning side to null (unless already changed)
            if ($ville->getBatiments() === $this) {
                $ville->setBatiments(null);
            }
        }

        return $this;
    }

    public function getCreaturesProduites(): ?Creature
    {
        return $this->creaturesProduites;
    }

    public function setCreaturesProduites(?Creature $creaturesProduites): self
    {
        $this->creaturesProduites = $creaturesProduites;

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

    public function getBatimentDebloque(): ?self
    {
        return $this->batimentDebloque;
    }

    public function setBatimentDebloque(?self $batimentDebloque): self
    {
        $this->batimentDebloque = $batimentDebloque;

        // set (or unset) the owning side of the relation if necessary
        $newBatimentNecessaire = $batimentDebloque === null ? null : $this;
        if ($newBatimentNecessaire !== $batimentDebloque->getBatimentNecessaire()) {
            $batimentDebloque->setBatimentNecessaire($newBatimentNecessaire);
        }

        return $this;
    }
}
