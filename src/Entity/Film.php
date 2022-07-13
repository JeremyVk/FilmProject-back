<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\FilmRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Api\UrlGeneratorInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: FilmRepository::class)]
#[ApiResource()]
class Film
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['user-read', 'film-read'])]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['film-read', 'film-write', 'user-read'])]
    private $title;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['film-read', 'film-write', 'user-read'])]
    private $year;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['film-read', 'film-write', 'user-read'])]
    private $gender;

    // #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'films', cascade: ['persist'])]
    // #[Groups(['film-read', 'film-write'])]
    // private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getYear(): ?string
    {
        return $this->year;
    }

    public function setYear(string $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    // public function getUsers()
    // {
    //     return $this->users->getValues();
    // }

    // public function addUser(User $user): self
    // {
    //     if (!$this->users->contains($user)) {
    //         $this->users[] = $user;
    //         $user->addFilm($this);
    //     }

    //     return $this;
    // }

    // public function removeUser(User $user): self
    // {
    //     if ($this->users->removeElement($user)) {
    //         $user->removeFilm($this);
    //     }

    //     return $this;
    // }
}
