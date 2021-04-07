<?php

namespace App\Entity;

use App\Repository\SpecialisationsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SpecialisationsRepository::class)
 */
class Specialisations
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbheure;

    /**
     * @ORM\OneToMany(targetEntity=Alternants::class, mappedBy="idSpe")
     */
    private $alternants;

    public function __construct()
    {
        $this->alternants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNbheure(): ?int
    {
        return $this->nbheure;
    }

    public function setNbheure(int $nbheure): self
    {
        $this->nbheure = $nbheure;

        return $this;
    }

    /**
     * @return Collection|Alternants[]
     */
    public function getAlternants(): Collection
    {
        return $this->alternants;
    }

    public function addAlternant(Alternants $alternant): self
    {
        if (!$this->alternants->contains($alternant)) {
            $this->alternants[] = $alternant;
            $alternant->setIdSpe($this);
        }

        return $this;
    }

    public function removeAlternant(Alternants $alternant): self
    {
        if ($this->alternants->removeElement($alternant)) {
            // set the owning side to null (unless already changed)
            if ($alternant->getIdSpe() === $this) {
                $alternant->setIdSpe(null);
            }
        }

        return $this;
    }
}
