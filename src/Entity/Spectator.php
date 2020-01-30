<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SpectatorRepository")
 */
class Spectator
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180)
     */
    private $email;

    /**
     * @ORM\Column(type="integer")
     */
    private $interestrate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Show", inversedBy="spectators")
     * @ORM\JoinColumn(nullable=false)
     */
    private $spectacle;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getInterestrate(): ?int
    {
        return $this->interestrate;
    }

    public function setInterestrate(int $interestrate): self
    {
        $this->interestrate = $interestrate;

        return $this;
    }

    public function getSpectacle(): ?Show
    {
        return $this->spectacle;
    }

    public function setSpectacle(?Show $spectacle): self
    {
        $this->spectacle = $spectacle;

        return $this;
    }
}
