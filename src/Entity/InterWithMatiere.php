<?php

namespace App\Entity;

use App\Repository\InterWithMatiereRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InterWithMatiereRepository::class)
 */
class InterWithMatiere
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Intervenants::class, inversedBy="idmat")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idinter;

    /**
     * @ORM\ManyToOne(targetEntity=Matieres::class, inversedBy="idintermat")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idmat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdinter(): ?Intervenants
    {
        return $this->idinter;
    }

    public function setIdinter(?Intervenants $idinter): self
    {
        $this->idinter = $idinter;

        return $this;
    }

    public function getIdmat(): ?Matieres
    {
        return $this->idmat;
    }

    public function setIdmat(?Matieres $idmat): self
    {
        $this->idmat = $idmat;

        return $this;
    }
}
