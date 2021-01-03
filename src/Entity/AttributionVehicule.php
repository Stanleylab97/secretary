<?php

namespace App\Entity;

use App\Repository\AttributionVehiculeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AttributionVehiculeRepository::class)
 */
class AttributionVehicule
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Personnel::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $chauffeur;

    /**
     * @ORM\ManyToOne(targetEntity=ParcAuto::class, inversedBy="dateAffectation")
     * @ORM\JoinColumn(nullable=false)
     */
    private $vehicule;

    /**
     * @ORM\Column(type="date")
     */
    private $dateAffectation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getChauffeur(): ?Personnel
    {
        return $this->chauffeur;
    }

    public function setChauffeur(?Personnel $chauffeur): self
    {
        $this->chauffeur = $chauffeur;

        return $this;
    }

    public function getVehicule(): ?ParcAuto
    {
        return $this->vehicule;
    }

    public function setVehicule(?ParcAuto $vehicule): self
    {
        $this->vehicule = $vehicule;

        return $this;
    }

    public function getDateAffectation(): ?\DateTimeInterface
    {
        return $this->dateAffectation;
    }

    public function setDateAffectation(\DateTimeInterface $dateAffectation): self
    {
        $this->dateAffectation = $dateAffectation;

        return $this;
    }
}
