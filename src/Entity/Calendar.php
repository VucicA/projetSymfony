<?php

namespace App\Entity;

use App\Repository\CalendarRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CalendarRepository::class)
 */
class Calendar
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
    private $title;

    /**
     * @ORM\Column(type="datetime")
     */
    private $start;

    /**
     * @ORM\Column(type="datetime")
     */
    private $end;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="boolean")
     */
    private $all_day;

    /**
     * @ORM\Column(type="boolean")
     */
    private $ferie;

    /**
     * @ORM\ManyToOne(targetEntity=Matieres::class)
     */
    private $IdMatiere;

    /**
     * @ORM\ManyToOne(targetEntity=Intervenants::class, inversedBy="calendars")
     * @ORM\JoinColumn(nullable=false)
     */
    private $IdInter;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getStart(): ?\DateTimeInterface
    {
        return $this->start;
    }

    public function setStart(\DateTimeInterface $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getEnd(): ?\DateTimeInterface
    {
        return $this->end;
    }

    public function setEnd(\DateTimeInterface $end): self
    {
        $this->end = $end;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAllDay(): ?bool
    {
        return $this->all_day;
    }

    public function setAllDay(bool $all_day): self
    {
        $this->all_day = $all_day;

        return $this;
    }

    public function getFerie(): ?bool
    {
        return $this->ferie;
    }

    public function setFerie(bool $ferie): self
    {
        $this->ferie = $ferie;

        return $this;
    }

    public function getIdMatiere(): ?Matieres
    {
        return $this->IdMatiere;
    }

    public function setIdMatiere(?Matieres $IdMatiere): self
    {
        $this->IdMatiere = $IdMatiere;

        return $this;
    }

    public function getIdInter(): ?Intervenants
    {
        return $this->IdInter;
    }

    public function setIdInter(?Intervenants $IdInter): self
    {
        $this->IdInter = $IdInter;

        return $this;
    }

}
