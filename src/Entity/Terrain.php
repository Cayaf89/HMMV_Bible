<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Description of Terrain
 *
 * @author Alexi
 */
class Terrain {
    private $id;
    private $factions;
    private $coutDeplacement;
    private $nom;
    
    public function __construct() {
        $this->factions = new ArrayCollection();
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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCoutDeplacement(): ?CoutDeplacement
    {
        return $this->coutDeplacement;
    }

    public function setCoutDeplacement(?CoutDeplacement $coutDeplacement): self
    {
        $this->coutDeplacement = $coutDeplacement;

        // set (or unset) the owning side of the relation if necessary
        $newTerrain = $coutDeplacement === null ? null : $this;
        if ($newTerrain !== $coutDeplacement->getTerrain()) {
            $coutDeplacement->setTerrain($newTerrain);
        }

        return $this;
    }

    public function getFactions(): ?Faction
    {
        return $this->factions;
    }

    public function setFactions(?Faction $factions): self
    {
        $this->factions = $factions;

        return $this;
    }
}
