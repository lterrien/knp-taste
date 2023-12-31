<?php

namespace App\Entity;

use App\Enum\UserRole;
use App\Repository\UserRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    private Uuid $uuid;

    #[ORM\Column(length: 180, unique: true)]
    private string $email;

    #[ORM\Column]
    private array $roles = [];

    #[ORM\Column(length: 100)]
    private string $hashedPassword = '';

    #[ORM\Column(length: 180, unique: true)]
    private string $username;

    #[ORM\Column(nullable: true)]
    private int $viewsCount = 0;

    #[ORM\Column(type: "datetime", nullable: true)]
    private ?DateTimeImmutable $lastCourseViewDate = null;

    public function __construct(Uuid $uuid, string $email, string $username)
    {
        $this->uuid = $uuid;
        $this->email = $email;
        $this->username = $username;
    }

    public function getUuid(): ?Uuid
    {
        return $this->uuid;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return $this->getEmail();
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    public function addRole(UserRole $role): static
    {
        if(!in_array($role, $this->roles)) {
            $this->roles[] = $role;
        }

        return $this;
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getHashedPassword(): string
    {
        return $this->hashedPassword;
    }

    public function setHashedPassword(string $hashedPassword): static
    {
        $this->hashedPassword = $hashedPassword;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->getHashedPassword();
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getViewsCount(): int
    {
        return $this->viewsCount;
    }

    public function setViewsCount(int $viewsCount): static
    {
        $this->viewsCount = $viewsCount;

        return $this;
    }

    public function getLastCourseViewDate(): ?DateTimeImmutable
    {
        return $this->lastCourseViewDate;
    }

    public function setLastCourseViewDate(?DateTimeImmutable $lastCourseViewDate): static
    {
        $this->lastCourseViewDate = $lastCourseViewDate;

        return $this;
    }
}
