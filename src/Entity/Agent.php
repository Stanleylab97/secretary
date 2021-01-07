<?php

namespace App\Entity;

use App\Repository\AgentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AgentRepository::class)
 */
class Agent
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $matricule;

    const SEXE=[
        0=>'Féminin',
        1=>'Masculin'
    ];
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sexe;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fonction;

    /**
     * @ORM\ManyToOne(targetEntity=Direction::class, inversedBy="agents")
     */
    private $direction;

    /**
     * @ORM\ManyToOne(targetEntity=Service::class, inversedBy="agents")
     */
    private $service;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $contact;

    /**
     * @ORM\ManyToOne(targetEntity=Mission::class, inversedBy="agent")
     */
    private $mission;

    /**
     * @ORM\OneToMany(targetEntity=Mission::class, mappedBy="agent")
     */
    private $missions;

    /**
     * @ORM\OneToMany(targetEntity=AffectationMateriel::class, mappedBy="agent")
     */
    private $affectationMateriels;

    public function __construct()
    {
        $this->missions = new ArrayCollection();
        $this->affectationMateriels = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getFonction(): ?string
    {
        return $this->fonction;
    }

    public function setFonction(string $fonction): self
    {
        $this->fonction = $fonction;

        return $this;
    }

    public function getDirection(): ?Direction
    {
        return $this->direction;
    }

    public function setDirection(?Direction $direction): self
    {
        $this->direction = $direction;

        return $this;
    }

    public function getService(): ?Service
    {
        return $this->service;
    }

    public function setService(?Service $service): self
    {
        $this->service = $service;

        return $this;
    }

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setContact(string $contact): self
    {
        $this->contact = $contact;

        return $this;
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

    /**
     * @return Collection|Mission[]
     */
    public function getMissions(): Collection
    {
        return $this->missions;
    }

    public function addMission(Mission $mission): self
    {
        if (!$this->missions->contains($mission)) {
            $this->missions[] = $mission;
            $mission->setAgent($this);
        }

        return $this;
    }

    public function removeMission(Mission $mission): self
    {
        if ($this->missions->removeElement($mission)) {
            // set the owning side to null (unless already changed)
            if ($mission->getAgent() === $this) {
                $mission->setAgent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|AffectationMateriel[]
     */
    public function getAffectationMateriels(): Collection
    {
        return $this->affectationMateriels;
    }

    public function addAffectationMateriel(AffectationMateriel $affectationMateriel): self
    {
        if (!$this->affectationMateriels->contains($affectationMateriel)) {
            $this->affectationMateriels[] = $affectationMateriel;
            $affectationMateriel->setAgent($this);
        }

        return $this;
    }

    public function removeAffectationMateriel(AffectationMateriel $affectationMateriel): self
    {
        if ($this->affectationMateriels->removeElement($affectationMateriel)) {
            // set the owning side to null (unless already changed)
            if ($affectationMateriel->getAgent() === $this) {
                $affectationMateriel->setAgent(null);
            }
        }

        return $this;
    }
}
