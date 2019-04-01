<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RolesRepository")
 */
class Roles
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Privileges", mappedBy="role", orphanRemoval=true)
     */
    private $privileges;

    public function __construct()
    {
        $this->privileges = new ArrayCollection();
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

    /**
     * @return Collection|Privileges[]
     */
    public function getPrivileges(): Collection
    {
        return $this->privileges;
    }

    public function addPrivilege(Privileges $privilege): self
    {
        if (!$this->privileges->contains($privilege)) {
            $this->privileges[] = $privilege;
            $privilege->setRole($this);
        }

        return $this;
    }

    public function removePrivilege(Privileges $privilege): self
    {
        if ($this->privileges->contains($privilege)) {
            $this->privileges->removeElement($privilege);
            // set the owning side to null (unless already changed)
            if ($privilege->getRole() === $this) {
                $privilege->setRole(null);
            }
        }

        return $this;
    }
}
