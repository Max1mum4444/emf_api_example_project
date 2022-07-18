<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CastRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CastRepository::class)
 */
class Cast
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", options={"unsigned":true})
     * @Assert\NotBlank()
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private string $fullName;

    /**
     * @ORM\ManyToMany(targetEntity=Movie::class, inversedBy="casts")
     */
    private Collection $movie;

    public function __construct()
    {
        $this->movie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): self
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * @return Collection<int, Movie>
     */
    public function getMovie(): Collection
    {
        return $this->movie;
    }

    public function addMovie(Movie $movie): self
    {
        if (!$this->movie->contains($movie)) {
            $this->movie[] = $movie;
        }

        return $this;
    }

    public function removeMovie(Movie $movie): self
    {
        $this->movie->removeElement($movie);

        return $this;
    }
}
