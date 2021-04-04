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
     * @ORM\OneToOne(targetEntity=Users::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user_id;

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

    public function getUserId(): ?users
    {
        return $this->user_id;
    }

    public function setUserId(users $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }
}
