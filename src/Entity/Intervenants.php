<?php

namespace App\Entity;

use App\Repository\IntervenantsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IntervenantsRepository::class)
 */
class Intervenants
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Users::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $IdUsers;

    /**
     * @ORM\OneToMany(targetEntity=InterWithMatiere::class, mappedBy="idinter")
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

    public function getIdUsers(): ?Users
    {
        return $this->IdUsers;
    }

    public function setIdUsers(Users $IdUsers): self
    {
        $this->IdUsers = $IdUsers;

        return $this;
    }

    /**
     * @return Collection|InterWithMatiere[]
     */
    public function getIdinterma(): Collection
    {
        return $this->idintermat;
    }

    public function addIdinterma(InterWithMatiere $idintermat): self
    {
        if (!$this->idintermat->contains($idintermat)) {
            $this->idintermat[] = $idintermat;
            $idintermat->setIdinter($this);
        }

        return $this;
    }

    public function removeIdintermat(InterWithMatiere $idintermat): self
    {
        if ($this->idintermat->removeElement($idintermat)) {
            // set the owning side to null (unless already changed)
            if ($idintermat->getIdinter() === $this) {
                $idintermat->setIdinter(null);
            }
        }

        return $this;
    }

 
}
