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
     * @ORM\Column(type="string", length=255)
     */
    private $Nom;

    /**
     * @ORM\Column(type="string", length=7)
     */
    private $BackgroundColor;

    /**
     * @ORM\Column(type="string", length=7)
     */
    private $TextColor;

    /**
     * @ORM\Column(type="string", length=7)
     */
    private $BorderColor;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbHeure;

    /**
     * @ORM\OneToMany(targetEntity=InterWithMatiere::class, mappedBy="idmat")
     */
    private $idintermat;

    public function __construct()
    {
        $this->idintermat = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getBackgroundColor(): ?string
    {
        return $this->BackgroundColor;
    }

    public function setBackgroundColor(string $BackgroundColor): self
    {
        $this->BackgroundColor = $BackgroundColor;

        return $this;
    }

    public function getTextColor(): ?string
    {
        return $this->TextColor;
    }

    public function setTextColor(string $TextColor): self
    {
        $this->TextColor = $TextColor;

        return $this;
    }

    public function getBorderColor(): ?string
    {
        return $this->BorderColor;
    }

    public function setBorderColor(string $BorderColor): self
    {
        $this->BorderColor = $BorderColor;

        return $this;
    }

    public function getNbHeure(): ?int
    {
        return $this->nbHeure;
    }

    public function setNbHeure(int $nbHeure): self
    {
        $this->nbHeure = $nbHeure;

        return $this;
    }

    /**
     * @return Collection|InterWithMatiere[]
     */
    public function getIdintermat(): Collection
    {
        return $this->idintermat;
    }

    public function addIdintermat(InterWithMatiere $idintermat): self
    {
        if (!$this->idintermat->contains($idintermat)) {
            $this->idintermat[] = $idintermat;
            $idintermat->setIdmat($this);
        }

        return $this;
    }

    public function removeIdintermat(InterWithMatiere $idintermat): self
    {
        if ($this->idintermat->removeElement($idintermat)) {
            // set the owning side to null (unless already changed)
            if ($idintermat->getIdmat() === $this) {
                $idintermat->setIdmat(null);
            }
        }

        return $this;
    }

  
}
