<?php

namespace App\Service\Factory;

use App\Entity\User;
use App\Enum\UserRole;
use App\Service\Uuid\UuidService;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFactory
{
    public function __construct(
        private readonly UuidService $uuidService,
        private readonly UserPasswordHasherInterface $userPasswordHasher
    )
    {
    }

    public function getUserInstance(string $email, string $plainPassword, string $username): User
    {
        $user = new User(
            $this->uuidService->generateUuid(),
            $email,
            $username
        );

        $user->setHashedPassword($this->userPasswordHasher->hashPassword($user, $plainPassword));
        $user->addRole(UserRole::RoleUser);

        return $user;
    }
}
