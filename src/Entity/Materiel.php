<?php

namespace App\Entity;

use App\Repository\MaterielRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MaterielRepository::class)
 */
class Materiel
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
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity=ApproMateriel::class, mappedBy="materiel")
     */
    private $approMateriels;

    /**
     * @ORM\OneToMany(targetEntity=AffectationMateriel::class, mappedBy="materiel")
     */
    private $affectationMateriels;

    /**
     * @ORM\OneToMany(targetEntity=StockMateriel::class, mappedBy="materiel")
     */
    private $stockMateriels;

    public function __construct()
    {
        $this->approMateriels = new ArrayCollection();
        $this->affectationMateriels = new ArrayCollection();
        $this->stockMateriels = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection|ApproMateriel[]
     */
    public function getApproMateriels(): Collection
    {
        return $this->approMateriels;
    }

    public function addApproMateriel(ApproMateriel $approMateriel): self
    {
        if (!$this->approMateriels->contains($approMateriel)) {
            $this->approMateriels[] = $approMateriel;
            $approMateriel->setMateriel($this);
        }

        return $this;
    }

    public function removeApproMateriel(ApproMateriel $approMateriel): self
    {
        if ($this->approMateriels->removeElement($approMateriel)) {
            // set the owning side to null (unless already changed)
            if ($approMateriel->getMateriel() === $this) {
                $approMateriel->setMateriel(null);
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
            $affectationMateriel->setMateriel($this);
        }

        return $this;
    }

    public function removeAffectationMateriel(AffectationMateriel $affectationMateriel): self
    {
        if ($this->affectationMateriels->removeElement($affectationMateriel)) {
            // set the owning side to null (unless already changed)
            if ($affectationMateriel->getMateriel() === $this) {
                $affectationMateriel->setMateriel(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|StockMateriel[]
     */
    public function getStockMateriels(): Collection
    {
        return $this->stockMateriels;
    }

    public function addStockMateriel(StockMateriel $stockMateriel): self
    {
        if (!$this->stockMateriels->contains($stockMateriel)) {
            $this->stockMateriels[] = $stockMateriel;
            $stockMateriel->setMateriel($this);
        }

        return $this;
    }

    public function removeStockMateriel(StockMateriel $stockMateriel): self
    {
        if ($this->stockMateriels->removeElement($stockMateriel)) {
            // set the owning side to null (unless already changed)
            if ($stockMateriel->getMateriel() === $this) {
                $stockMateriel->setMateriel(null);
            }
        }

        return $this;
    }
}
