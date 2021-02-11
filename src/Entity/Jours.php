<?php

namespace App\Entity;

use App\Repository\JoursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=JoursRepository::class)
 */
class Jours
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
    private $isFerie;

    /**
     * @ORM\ManyToOne(targetEntity=Semaines::class, inversedBy="jours")
     * @ORM\JoinColumn(nullable=false)
     */
    private $semaine_id;

    /**
     * @ORM\OneToMany(targetEntity=Heures::class, mappedBy="jour_id", orphanRemoval=true)
     */
    private $heures;

    public function __construct()
    {
        $this->heures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsFerie(): ?bool
    {
        return $this->isFerie;
    }

    public function setIsFerie(bool $isFerie): self
    {
        $this->isFerie = $isFerie;

        return $this;
    }

    public function getSemaineId(): ?Semaines
    {
        return $this->semaine_id;
    }

    public function setSemaineId(?Semaines $semaine_id): self
    {
        $this->semaine_id = $semaine_id;

        return $this;
    }

    /**
     * @return Collection|Heures[]
     */
    public function getHeures(): Collection
    {
        return $this->heures;
    }

    public function addHeure(Heures $heure): self
    {
        if (!$this->heures->contains($heure)) {
            $this->heures[] = $heure;
            $heure->setJourId($this);
        }

        return $this;
    }

    public function removeHeure(Heures $heure): self
    {
        if ($this->heures->removeElement($heure)) {
            // set the owning side to null (unless already changed)
            if ($heure->getJourId() === $this) {
                $heure->setJourId(null);
            }
        }

        return $this;
    }
}
