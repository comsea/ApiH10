<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\ImageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['images:read']],
    denormalizationContext: ['groups' => ['images:write']],
)]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["images:read", "images:write"])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(["images:read", "images:write"])]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Groups(["images:read", "images:write"])]
    private ?string $path = null;

    #[ORM\ManyToMany(targetEntity: Actualite::class, mappedBy: 'gallery')]
    #[Groups(["images:read", "images:write"])]
    private Collection $actualites;

    public function __construct()
    {
        $this->actualites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): static
    {
        $this->path = $path;

        return $this;
    }

    /**
     * @return Collection<int, Actualite>
     */
    public function getActualites(): Collection
    {
        return $this->actualites;
    }

    public function addActualite(Actualite $actualite): static
    {
        if (!$this->actualites->contains($actualite)) {
            $this->actualites->add($actualite);
            $actualite->addGallery($this);
        }

        return $this;
    }

    public function removeActualite(Actualite $actualite): static
    {
        if ($this->actualites->removeElement($actualite)) {
            $actualite->removeGallery($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
