<?php

namespace App\Entity;

use App\Repository\MissionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Integer;

/**
 * @ORM\Entity(repositoryClass=MissionRepository::class)
 */
class Mission
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
    private $lieu;

    const Moyen=[
        '0'=>"Véhicule de service",
        '1'=>"Taxi",
        '2'=>"Avion",       
    ];

    const TYPEMISSION=[
        '0'=>"Ponctuelle",
        '1'=>"Tournée"  
    ];

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $moyen;

   

    

    /**
     * @ORM\Column(type="integer")
     */
    private $primeChef;

    /**
     * @ORM\Column(type="text")
     */
    private $objet;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $noteService;

    /**
     * @ORM\Column(type="date")
     */
    private $dateDepart;

    /**
     * @ORM\Column(type="date")
     */
    private $dateRetour;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbjrs;

    /**
     * @ORM\OneToMany(targetEntity=TrajetMission::class, mappedBy="mission")
     */
    private $trajetMissions;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $typeMission;

    /**
     * @ORM\ManyToOne(targetEntity=Agent::class, inversedBy="missions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $agent;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $savedBy;

    /**
     * @ORM\Column(type="boolean")
     */
    private $traitement;


    public function __construct()
    {
        $this->trajetMissions = new ArrayCollection();
        
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getMoyen(): ?string
    {
        return $this->moyen;
    }

    public function setMoyen(string $moyen): self
    {
        $this->moyen = $moyen;

        return $this;
    }

    public function getConducteur(): ?string
    {
        return $this->conducteur;
    }

    public function setConducteur(string $conducteur): self
    {
        $this->conducteur = $conducteur;

        return $this;
    }

  

    public function getPrimeChef(): ?int
    {
        return $this->primeChef;
    }

    public function setPrimeChef(int $primeChef): self
    {
        $this->primeChef = $primeChef;

        return $this;
    }

    public function getObjet(): ?string
    {
        return $this->objet;
    }

    public function setObjet(string $objet): self
    {
        $this->objet = $objet;

        return $this;
    }

    public function getNoteService(): ?string
    {
        return $this->noteService;
    }

    public function setNoteService(string $noteService): self
    {
        $this->noteService = $noteService;

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

    public function getDateRetour(): ?\DateTimeInterface
    {
        return $this->dateRetour;
    }

    public function setDateRetour(\DateTimeInterface $dateRetour): self
    {
        $this->dateRetour = $dateRetour;

        return $this;
    }

    public function getNbjrs(): ?int
    {
        return $this->nbjrs;
    }

    public function setNbjrs(int $nbjrs): self
    {
        $this->nbjrs = $nbjrs;

        return $this;
    }

    /**
     * @return Collection|TrajetMission[]
     */
    public function getTrajetMissions(): Collection
    {
        return $this->trajetMissions;
    }

    public function addTrajetMission(TrajetMission $trajetMission): self
    {
        if (!$this->trajetMissions->contains($trajetMission)) {
            $this->trajetMissions[] = $trajetMission;
            $trajetMission->setMission($this);
        }

        return $this;
    }

    public function removeTrajetMission(TrajetMission $trajetMission): self
    {
        if ($this->trajetMissions->removeElement($trajetMission)) {
            // set the owning side to null (unless already changed)
            if ($trajetMission->getMission() === $this) {
                $trajetMission->setMission(null);
            }
        }

        return $this;
    }

    public function getTypeMission(): ?string
    {
        return $this->typeMission;
    }

    public function setTypeMission(string $typeMission): self
    {
        $this->typeMission = $typeMission;

        return $this;
    }

    public function getAgent(): ?Agent
    {
        return $this->agent;
    }

    public function setAgent(?Agent $agent): self
    {
        $this->agent = $agent;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getSavedBy(): ?string
    {
        return $this->savedBy;
    }

    public function setSavedBy(string $savedBy): self
    {
        $this->savedBy = $savedBy;

        return $this;
    }

    public function getTraitement(): ?bool
    {
        return $this->traitement;
    }

    public function setTraitement(bool $traitement): self
    {
        $this->traitement = $traitement;

        return $this;
    }


  
}