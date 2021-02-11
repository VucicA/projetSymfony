<?php

namespace App\Entity;

use App\Repository\SemainesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SemainesRepository::class)
 */
class Semaines
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isSemaineCours;

    /**
     * @ORM\OneToMany(targetEntity=Jours::class, mappedBy="semaine_id", orphanRemoval=true)
     */
    private $jours;

    public function __construct()
    {
        $this->jours = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsSemaineCours(): ?bool
    {
        return $this->isSemaineCours;
    }

    public function setIsSemaineCours(bool $isSemaineCours): self
    {
        $this->isSemaineCours = $isSemaineCours;

        return $this;
    }

    /**
     * @return Collection|Jours[]
     */
    public function getJours(): Collection
    {
        return $this->jours;
    }

    public function addJour(Jours $jour): self
    {
        if (!$this->jours->contains($jour)) {
            $this->jours[] = $jour;
            $jour->setSemaineId($this);
        }

        return $this;
    }

    public function removeJour(Jours $jour): self
    {
        if ($this->jours->removeElement($jour)) {
            // set the owning side to null (unless already changed)
            if ($jour->getSemaineId() === $this) {
                $jour->setSemaineId(null);
            }
        }

        return $this;
    }
}
