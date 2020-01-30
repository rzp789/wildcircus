<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ShowRepository")
 * @ORM\Table(name="shows")
 */
class Show
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="shows", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $manager;

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
     * @ORM\Column(type="boolean")
     */
    private $projectlaunch;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $picture;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbspectator;

    /**
     * @ORM\Column(type="boolean")
     */
    private $checkspectator;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="showsactor")
     */
    private $actors;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Spectator", mappedBy="spectacle", orphanRemoval=true)
     */
    private $spectators;

    public function __construct()
    {
        $this->manager = new User();
        $this->actors = new ArrayCollection();
        $this->spectators = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getManager(): ?User
    {
        return $this->manager;
    }

    public function setManager(?User $manager): self
    {
        $this->manager = $manager;

        return $this;
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

    public function getProjectlaunch(): ?bool
    {
        return $this->projectlaunch;
    }

    public function setProjectlaunch(bool $projectlaunch): self
    {
        $this->projectlaunch = $projectlaunch;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

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

    public function getCheckspectator(): ?bool
    {
        return $this->checkspectator;
    }

    public function setCheckspectator(bool $checkspectator): self
    {
        $this->checkspectator = $checkspectator;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getActors(): Collection
    {
        return $this->actors;
    }

    public function addActor(User $actor): self
    {
        if (!$this->actors->contains($actor)) {
            $this->actors[] = $actor;
        }

        return $this;
    }

    public function removeActor(User $actor): self
    {
        if ($this->actors->contains($actor)) {
            $this->actors->removeElement($actor);
        }

        return $this;
    }

    /**
     * @return Collection|Spectator[]
     */
    public function getSpectators(): Collection
    {
        return $this->spectators;
    }

    public function addSpectator(Spectator $spectator): self
    {
        if (!$this->spectators->contains($spectator)) {
            $this->spectators[] = $spectator;
            $spectator->setSpectacle($this);
        }

        return $this;
    }

    public function removeSpectator(Spectator $spectator): self
    {
        if ($this->spectators->contains($spectator)) {
            $this->spectators->removeElement($spectator);
            // set the owning side to null (unless already changed)
            if ($spectator->getSpectacle() === $this) {
                $spectator->setSpectacle(null);
            }
        }

        return $this;
    }
}
