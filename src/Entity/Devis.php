<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * @ApiResource(normalizationContext={"groups"={"read", "prestataires"}, "enable_max_depth"=true})
 * @ORM\Entity(repositoryClass="App\Repository\DevisRepository")
 */
class Devis
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"read", "prestataires"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"read", "prestataires"})
     */
    private $numero;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"read"})
     */
    private $dateEmission;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"read"})
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Prestataires", inversedBy="devis")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"read"})
     * @MaxDepth(1)
     */
    private $prestataire;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Clients", inversedBy="devis")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"read"})
     * @MaxDepth(1)
     */
    private $client;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getDateEmission(): ?\DateTimeInterface
    {
        return $this->dateEmission;
    }

    public function setDateEmission(\DateTimeInterface $dateEmission): self
    {
        $this->dateEmission = $dateEmission;

        return $this;
    }

    public function getPrestataire(): ?Prestataires
    {
        return $this->prestataire;
    }

    public function setPrestataire(?Prestataires $prestataire): self
    {
        $this->prestataire = $prestataire;

        return $this;
    }

    public function getClient(): ?Clients
    {
        return $this->client;
    }

    public function setClient(?Clients $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }
}
