<?php

namespace App\Entity;

use App\Repository\AlternantsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AlternantsRepository::class)
 */
class Alternants
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
    private $idUsers;

    /**
     * @ORM\ManyToOne(targetEntity=Specialisations::class, inversedBy="alternants")
     */
    private $idSpe;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUsers(): ?Users
    {
        return $this->idUsers;
    }

    public function setIdUsers(Users $idUsers): self
    {
        $this->idUsers = $idUsers;

        return $this;
    }

    public function getIdSpe(): ?Specialisations
    {
        return $this->idSpe;
    }

    public function setIdSpe(?Specialisations $idSpe): self
    {
        $this->idSpe = $idSpe;

        return $this;
    }

 
}
