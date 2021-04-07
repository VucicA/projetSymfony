<?php

namespace App\Entity;

use App\Repository\SecretairesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SecretairesRepository::class)
 */
class Secretaires
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

}
