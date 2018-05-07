<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Magie {
    private $id;
    private $sorts;
    private $factionsPreference;
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

    public function getSorts(): ?Sort
    {
        return $this->sorts;
    }

    public function setSorts(?Sort $sorts): self
    {
        $this->sorts = $sorts;

        return $this;
    }

    public function getFactionsPreference(): ?ArrayCollection
    {
        return $this->factionsPreference;
    }

    public function addFactionsPreference(Faction $factionsPreference): self
    {
        if (!$this->factionsPreference->contains($factionsPreference)) {
            $this->factionsPreference[] = $factionsPreference;
        }

        return $this;
    }

    public function removeFactionsPreference(Faction $factionsPreference): self
    {
        if ($this->factionsPreference->contains($factionsPreference)) {
            $this->factionsPreference->removeElement($factionsPreference);
        }

        return $this;
    }
}
