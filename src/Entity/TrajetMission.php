<?php

namespace App\Entity;

use App\Repository\TrajetMissionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TrajetMissionRepository::class)
 */
class TrajetMission
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Mission::class, inversedBy="trajetMissions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $mission;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lieuDepart;

    /**
     * @ORM\Column(type="date")
     */
    private $dateDepart;

    /**
     * @ORM\Column(type="time")
     */
    private $heureDepart;

    /**
     * @ORM\Column(type="date")
     */
    private $dateRetour;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lieuRetour;

    /**
     * @ORM\Column(type="time")
     */
    private $heureRetourApproximatif;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMission(): ?Mission
    {
        return $this->mission;
    }

    public function setMission(?Mission $mission): self
    {
        $this->mission = $mission;

        return $this;
    }

    public function getLieuDepart(): ?string
    {
        return $this->lieuDepart;
    }

    public function setLieuDepart(string $lieuDepart): self
    {
        $this->lieuDepart = $lieuDepart;

        return $this;
    }

    public function getDateDepart(): ?\DateTimeInterface
    {
        return $this->dateDepart;
    }

    public function setDateDepart(\DateTimeInterface $dateDepart): self
    {
        $this->dateDepart = $dateDepart;

        return $this;
    }

    public function getHeureDepart(): ?\DateTimeInterface
    {
        return $this->heureDepart;
    }

    public function setHeureDepart(\DateTimeInterface $heureDepart): self
    {
        $this->heureDepart = $heureDepart;

        return $this;
    }

    public function getDateRetour(): ?\DateTimeInterface
    {
        return $this->dateRetour;
    }

    public function setDateRetour(\DateTimeInterface $dateRetour): self
    {
        $this->dateRetour = $dateRetour;

        return $this;
    }

    public function getLieuRetour(): ?string
    {
        return $this->lieuRetour;
    }

    public function setLieuRetour(string $lieuRetour): self
    {
        $this->lieuRetour = $lieuRetour;

        return $this;
    }

    public function getHeureRetourApproximatif(): ?\DateTimeInterface
    {
        return $this->heureRetourApproximatif;
    }

    public function setHeureRetourApproximatif(\DateTimeInterface $heureRetourApproximatif): self
    {
        $this->heureRetourApproximatif = $heureRetourApproximatif;

        return $this;
    }
}
