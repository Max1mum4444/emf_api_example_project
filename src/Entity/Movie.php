<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MovieRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MovieRepository::class)
 * @ApiResource(
 *     collectionOperations={
 *         "get"={"method"="GET"},
 *         "post"={"method"="POST"}
 *     },
 *     itemOperations={
 *         "get"={"method"="GET"},
 *     }
 * )
 */
class Movie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private DateTimeInterface $releaseDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $director;

    /**
     * @ORM\ManyToMany(targetEntity=Cast::class, mappedBy="movie")
     */
    private ArrayCollection $casts;

    /**
     * @ORM\ManyToMany(targetEntity=Rating::class, mappedBy="movie")
     */
    private ArrayCollection $ratings;

    public function __construct()
    {
        $this->casts = new ArrayCollection();
        $this->ratings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getReleaseDate(): ?DateTimeInterface
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(?DateTimeInterface $releaseDate): self
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    public function getDirector(): ?string
    {
        return $this->director;
    }

    public function setDirector(string $director): self
    {
        $this->director = $director;

        return $this;
    }

    /**
     * @return Collection<int, Cast>
     */
    public function getCasts(): Collection
    {
        return $this->casts;
    }

    public function addCast(Cast $cast): self
    {
        if (!$this->casts->contains($cast)) {
            $this->casts[] = $cast;
            $cast->addMovie($this);
        }

        return $this;
    }

    public function removeCast(Cast $cast): self
    {
        if ($this->casts->removeElement($cast)) {
            $cast->removeMovie($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Rating>
     */
    public function getRatings(): Collection
    {
        return $this->ratings;
    }

    public function addRating(Rating $rating): self
    {
        if (!$this->ratings->contains($rating)) {
            $this->ratings[] = $rating;
            $rating->addMovie($this);
        }

        return $this;
    }

    public function removeRating(Rating $rating): self
    {
        if ($this->ratings->removeElement($rating)) {
            $rating->removeMovie($this);
        }

        return $this;
    }
}
