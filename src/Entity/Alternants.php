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
     * @ORM\Column(type="string", length=45)
     */
    private $specialisationAlternant;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomAlternant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenomAlternant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mailAlternant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSpecialisationAlternant(): ?string
    {
        return $this->specialisationAlternant;
    }

    public function setSpecialisationAlternant(string $specialisationAlternant): self
    {
        $this->specialisationAlternant = $specialisationAlternant;

        return $this;
    }


    public function getNomAlternant(): ?string
    {
        return $this->nomAlternant;
    }

    public function setNomAlternant(string $nomAlternant): self
    {
        $this->nomAlternant = $nomAlternant;

        return $this;
    }

    public function getPrenomAlternant(): ?string
    {
        return $this->prenomAlternant;
    }

    public function setPrenomAlternant(string $prenomAlternant): self
    {
        $this->prenomAlternant = $prenomAlternant;

        return $this;
    }

    public function getMailAlternant(): ?string
    {
        return $this->mailAlternant;
    }

    public function setMailAlternant(string $mailAlternant): self
    {
        $this->mailAlternant = $mailAlternant;

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
