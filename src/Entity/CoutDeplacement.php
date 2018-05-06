<?php

namespace App\Entity;

/**
 * Description of CoutDeplacement
 *
 * @author Alexis
 */
class CoutDeplacement {
    private $id;
    private $terrain;
    private $coutDeMouvement;
    private $deplacementDiagonal;

    public function getCoutDeMouvement(): ?int
    {
        return $this->coutDeMouvement;
    }

    public function setCoutDeMouvement(int $coutDeMouvement): self
    {
        $this->coutDeMouvement = $coutDeMouvement;

        return $this;
    }

    public function getDeplacementDiagonal(): ?int
    {
        return $this->deplacementDiagonal;
    }

    public function setDeplacementDiagonal(int $deplacementDiagonal): self
    {
        $this->deplacementDiagonal = $deplacementDiagonal;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTerrain(): ?Terrain
    {
        return $this->terrain;
    }

    public function setTerrain(?Terrain $terrain): self
    {
        $this->terrain = $terrain;

        // set (or unset) the owning side of the relation if necessary
        $newCoutDeplacement = $terrain === null ? null : $this;
        if ($newCoutDeplacement !== $terrain->getCoutDeplacement()) {
            $terrain->setCoutDeplacement($newCoutDeplacement);
        }

        return $this;
    }
}
