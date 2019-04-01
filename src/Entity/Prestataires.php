<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(normalizationContext={"groups"={"devis", "prestataires"}})
 * @ORM\Entity(repositoryClass="App\Repository\PrestatairesRepository")
 */
class Prestataires
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"prestataires"})
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Groups({"prestataires"})
     */
    private $prenoms;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"prestataires"})
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     * @Groups({"prestataires"})
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Groups({"prestataires"})
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Devis", mappedBy="prestataire")
     * @Groups({"prestataires"})
     */
    private $devis;

    public function __construct()
    {
        $this->devis = new ArrayCollection();
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

    public function getPrenoms(): ?string
    {
        return $this->prenoms;
    }

    public function setPrenoms(?string $prenoms): self
    {
        $this->prenoms = $prenoms;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection|Devis[]
     */
    public function getDevis(): Collection
    {
        return $this->devis;
    }

    public function addDevi(Devis $devi): self
    {
        if (!$this->devis->contains($devi)) {
            $this->devis[] = $devi;
            $devi->setPrestataire($this);
        }

        return $this;
    }

    public function removeDevi(Devis $devi): self
    {
        if ($this->devis->contains($devi)) {
            $this->devis->removeElement($devi);
            // set the owning side to null (unless already changed)
            if ($devi->getPrestataire() === $this) {
                $devi->setPrestataire(null);
            }
        }

        return $this;
    }
}
