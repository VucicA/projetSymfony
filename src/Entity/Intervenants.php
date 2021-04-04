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
     * @ORM\ManyToMany(targetEntity=Heures::class, mappedBy="intervenant_id")
     */
    private $heures;

    /**
     * @ORM\OneToMany(targetEntity=Matieres::class, mappedBy="intervenant_id")
     */
    private $matieres;

    /**
     * @ORM\OneToOne(targetEntity=Users::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomIntervenant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenomIntervenant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mailIntervenant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    public function __construct()
    {
        $this->heures = new ArrayCollection();
        $this->matieres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $heure->addIntervenantId($this);
        }

        return $this;
    }

    public function removeHeure(Heures $heure): self
    {
        if ($this->heures->removeElement($heure)) {
            $heure->removeIntervenantId($this);
        }

        return $this;
    }

    /**
     * @return Collection|Matieres[]
     */
    public function getMatieres(): Collection
    {
        return $this->matieres;
    }

    public function addMatiere(Matieres $matiere): self
    {
        if (!$this->matieres->contains($matiere)) {
            $this->matieres[] = $matiere;
            $matiere->setIntervenantId($this);
        }

        return $this;
    }

    public function removeMatiere(Matieres $matiere): self
    {
        if ($this->matieres->removeElement($matiere)) {
            // set the owning side to null (unless already changed)
            if ($matiere->getIntervenantId() === $this) {
                $matiere->setIntervenantId(null);
            }
        }

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

    public function getNomIntervenant(): ?string
    {
        return $this->nomIntervenant;
    }

    public function setNomIntervenant(string $nomIntervenant): self
    {
        $this->nomIntervenant = $nomIntervenant;

        return $this;
    }

    public function getPrenomIntervenant(): ?string
    {
        return $this->prenomIntervenant;
    }

    public function setPrenomIntervenant(string $prenomIntervenant): self
    {
        $this->prenomIntervenant = $prenomIntervenant;

        return $this;
    }

    public function getMailIntervenant(): ?string
    {
        return $this->mailIntervenant;
    }

    public function setMailIntervenant(string $mailIntervenant): self
    {
        $this->mailIntervenant = $mailIntervenant;

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
