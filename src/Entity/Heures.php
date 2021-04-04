<?php

namespace App\Entity;

use App\Repository\HeuresRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HeuresRepository::class)
 */
class Heures
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Jours::class, inversedBy="heures")
     * @ORM\JoinColumn(nullable=false)
     */
    private $jour_id;

    /**
     * @ORM\ManyToMany(targetEntity=Intervenants::class, inversedBy="heures")
     */
    private $intervenant_id;

    /**
     * @ORM\ManyToMany(targetEntity=Matieres::class, inversedBy="heures")
     */
    private $matiere_id;

    public function __construct()
    {
        $this->intervenant_id = new ArrayCollection();
        $this->matiere_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJourId(): ?Jours
    {
        return $this->jour_id;
    }

    public function setJourId(?Jours $jour_id): self
    {
        $this->jour_id = $jour_id;

        return $this;
    }

    /**
     * @return Collection|Intervenants[]
     */
    public function getIntervenantId(): Collection
    {
        return $this->intervenant_id;
    }

    public function addIntervenantId(Intervenants $intervenantId): self
    {
        if (!$this->intervenant_id->contains($intervenantId)) {
            $this->intervenant_id[] = $intervenantId;
        }

        return $this;
    }

    public function removeIntervenantId(Intervenants $intervenantId): self
    {
        $this->intervenant_id->removeElement($intervenantId);

        return $this;
    }

    /**
     * @return Collection|matieres[]
     */
    public function getMatiereId(): Collection
    {
        return $this->matiere_id;
    }

    public function addMatiereId(matieres $matiereId): self
    {
        if (!$this->matiere_id->contains($matiereId)) {
            $this->matiere_id[] = $matiereId;
        }

        return $this;
    }

    public function removeMatiereId(matieres $matiereId): self
    {
        $this->matiere_id->removeElement($matiereId);

        return $this;
    }
}
