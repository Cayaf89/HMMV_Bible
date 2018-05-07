<?php

namespace App\Entity;

class EstimationNbCreature {
    private $id;
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

    public function getQuantite(): ?string
    {
        return $this->quantite;
    }

    public function setQuantite(string $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    
}
