<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\EmployeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployeRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['employes:read']],
    denormalizationContext: ['groups' => ['employes:write']],
)]
class Employe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["employes:read", "employes:write"])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(["employes:read", "employes:write"])]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    #[Groups(["employes:read", "employes:write"])]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    #[Groups(["employes:read", "employes:write"])]
    private ?string $lastname = null;

    #[ORM\Column(length: 255)]
    #[Groups(["employes:read", "employes:write"])]
    private ?string $job = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(["employes:read", "employes:write"])]
    private ?string $profil = null;

    #[ORM\ManyToOne(inversedBy: 'employes')]
    #[Groups(["employes:read", "employes:write"])]
    private ?Cabinet $cabinet = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getJob(): ?string
    {
        return $this->job;
    }

    public function setJob(string $job): static
    {
        $this->job = $job;

        return $this;
    }

    public function getProfil(): ?string
    {
        return $this->profil;
    }

    public function setProfil(?string $profil): static
    {
        $this->profil = $profil;

        return $this;
    }

    public function getCabinet(): ?Cabinet
    {
        return $this->cabinet;
    }

    public function setCabinet(?Cabinet $cabinet): static
    {
        $this->cabinet = $cabinet;

        return $this;
    }
}
