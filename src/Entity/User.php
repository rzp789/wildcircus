<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="array")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $nickname;

    /**
     * @ORM\Column(type="text")
     */
    private $personaldescription;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $video;

    /**
     * @ORM\Column(type="text")
     */
    private $avatar;
    /**
     * @ORM\Column(type="string", length=20)
     */
    private $categoryactivity;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $ownactivity;

    /**
     * @ORM\Column(type="text")
     */
    private $descriptionownactivity;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $picture;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Show", mappedBy="manager", orphanRemoval=true)
     */
    private $shows;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Show", mappedBy="actors")
     */
    private $showsactor;

    /**
     * @ORM\Column(type="blob", nullable=true)
     */
    private $profil;

    public function __construct()
    {
        $this->roles = ['ROLE_USER'];
        $this->shows = new ArrayCollection();
        $this->showsactor = new ArrayCollection();
    }

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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    public function setNickname(string $nickname): self
    {
        $this->nickname = $nickname;

        return $this;
    }

    public function getPersonaldescription(): ?string
    {
        return $this->personaldescription;
    }

    public function setPersonaldescription(string $personaldescription): self
    {
        $this->personaldescription = $personaldescription;

        return $this;
    }

    public function getVideo(): ?string
    {
        return $this->video;
    }

    public function setVideo(?string $video): self
    {
        $this->video = $video;

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getCategoryactivity(): ?string
    {
        return $this->categoryactivity;
    }

    public function setCategoryactivity(string $categoryactivity): self
    {
        $this->categoryactivity = $categoryactivity;

        return $this;
    }

    public function getOwnactivity(): ?string
    {
        return $this->ownactivity;
    }

    public function setOwnactivity(string $ownactivity): self
    {
        $this->ownactivity = $ownactivity;

        return $this;
    }

    public function getDescriptionownactivity(): ?string
    {
        return $this->descriptionownactivity;
    }

    public function setDescriptionownactivity(string $descriptionownactivity): self
    {
        $this->descriptionownactivity = $descriptionownactivity;

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

    /**
     * @return Collection|Show[]
     */
    public function getShows(): Collection
    {
        return $this->shows;
    }

    public function addShow(?Show $show): self
    {
        if (!$this->shows->contains($show)) {
            $this->shows[] = $show;
            $show->setManager($this);
        }

        return $this;
    }

    public function removeShow(Show $show): self
    {
        if ($this->shows->contains($show)) {
            $this->shows->removeElement($show);
            // set the owning side to null (unless already changed)
            if ($show->getManager() === $this) {
                $show->setManager(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Show[]
     */
    public function getShowsactor(): Collection
    {
        return $this->showsactor;
    }

    public function addShowsactor(?Show $showsactor, $showactor=[]): self
    {
        if (!$this->showsactor->contains($showsactor)) {
            $this->showsactor[] = $showsactor;
            $showsactor->addActor($this);
        }

        return $this;
    }

    public function removeShowsactor(Show $showsactor): self
    {
        if ($this->showsactor->contains($showsactor)) {
            $this->showsactor->removeElement($showsactor);
            $showsactor->removeActor($this);
        }

        return $this;
    }

    public function getProfil()
    {
        return $this->profil;
    }

    public function setProfil($profil): self
    {
        $this->profil = $profil;

        return $this;
    }
}
