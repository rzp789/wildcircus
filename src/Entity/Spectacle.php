<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SpectacleRepository")
 */
class Spectacle
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $departement;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $price;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $photo;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbspectator;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Spectateur", mappedBy="spectacle")
     */
    private $spectateurs;

    /**
     * @ORM\Column(type="integer")
     */
    private $countspectateur = 0;

    public function __construct()
    {
        $this->spectateurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDepartement(): ?string
    {
        return $this->departement;
    }

    public function setDepartement(string $departement): self
    {
        $this->departement = $departement;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getNbspectator(): ?int
    {
        return $this->nbspectator;
    }

    public function setNbspectator(?int $nbspectator): self
    {
        $this->nbspectator = $nbspectator;

        return $this;
    }

    /**
     * @return Collection|Spectateur[]
     */
    public function getSpectateurs(): Collection
    {
        return $this->spectateurs;
    }

    public function addSpectateur(Spectateur $spectateur): self
    {
        if (!$this->spectateurs->contains($spectateur)) {
            $this->spectateurs[] = $spectateur;
            $spectateur->setSpectacle($this);
        }

        return $this;
    }

    public function removeSpectateur(Spectateur $spectateur): self
    {
        if ($this->spectateurs->contains($spectateur)) {
            $this->spectateurs->removeElement($spectateur);
            // set the owning side to null (unless already changed)
            if ($spectateur->getSpectacle() === $this) {
                $spectateur->setSpectacle(null);
            }
        }

        return $this;
    }

    public function getCountspectateur(): ?int
    {
        return $this->countspectateur;
    }

    public function setCountspectateur(int $countspectateur): self
    {
        $this->countspectateur = $countspectateur;

        return $this;
    }
}
