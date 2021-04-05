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
    private $user_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomSecretaire;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenomSecretaire;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mailSecretaire;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?users
    {
        return $this->user_id;
    }

    public function setUserId(users $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getNomSecretaire(): ?string
    {
        return $this->nomSecretaire;
    }

    public function setNomSecretaire(string $nomSecretaire): self
    {
        $this->nomSecretaire = $nomSecretaire;

        return $this;
    }

    public function getPrenomSecretaire(): ?string
    {
        return $this->prenomSecretaire;
    }

    public function setPrenomSecretaire(string $prenomSecretaire): self
    {
        $this->prenomSecretaire = $prenomSecretaire;

        return $this;
    }

    public function getMailSecretaire(): ?string
    {
        return $this->mailSecretaire;
    }

    public function setMailSecretaire(string $mailSecretaire): self
    {
        $this->mailSecretaire = $mailSecretaire;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
}
