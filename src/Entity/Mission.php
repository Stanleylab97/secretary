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

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $moyen;

   

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $chefMission;

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

    public function getChefMission(): ?string
    {
        return $this->chefMission;
    }

    public function setChefMission(string $chefMission): self
    {
        $this->chefMission = $chefMission;

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


  
}
