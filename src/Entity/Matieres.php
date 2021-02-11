<?php

namespace App\Entity;

use App\Repository\MatieresRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MatieresRepository::class)
 */
class Matieres
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $nomMatiere;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbHeuresMatiere;

    /**
     * @ORM\ManyToMany(targetEntity=Heures::class, mappedBy="matiere_id")
     */
    private $heures;

    /**
     * @ORM\ManyToOne(targetEntity=intervenants::class, inversedBy="matieres")
     */
    private $intervenant_id;

    public function __construct()
    {
        $this->heures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomMatiere(): ?string
    {
        return $this->nomMatiere;
    }

    public function setNomMatiere(string $nomMatiere): self
    {
        $this->nomMatiere = $nomMatiere;

        return $this;
    }

    public function getNbHeuresMatiere(): ?int
    {
        return $this->nbHeuresMatiere;
    }

    public function setNbHeuresMatiere(int $nbHeuresMatiere): self
    {
        $this->nbHeuresMatiere = $nbHeuresMatiere;

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
            $heure->addMatiereId($this);
        }

        return $this;
    }

    public function removeHeure(Heures $heure): self
    {
        if ($this->heures->removeElement($heure)) {
            $heure->removeMatiereId($this);
        }

        return $this;
    }

    public function getIntervenantId(): ?intervenants
    {
        return $this->intervenant_id;
    }

    public function setIntervenantId(?intervenants $intervenant_id): self
    {
        $this->intervenant_id = $intervenant_id;

        return $this;
    }
}
