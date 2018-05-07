<?php

namespace App\Entity;

class Panoplie {
    private $id;
    private $artefacts;
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

    public function getArtefacts(): ?Artefact
    {
        return $this->artefacts;
    }

    public function setArtefacts(?Artefact $artefacts): self
    {
        $this->artefacts = $artefacts;

        return $this;
    }
    
}
