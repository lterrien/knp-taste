<?php

namespace spec\App\Service\Factory;

use App\Entity\User;
use App\Service\Factory\UserFactory;
use App\Service\Uuid\UuidService;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Uid\Uuid;

class UserFactorySpec extends ObjectBehavior
{
    function let(UuidService $uuidService, UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->beConstructedWith($uuidService, $userPasswordHasher);
    }

    function it_is_initializable(): void
    {
        $this->shouldHaveType(UserFactory::class);
    }

    function it_creates_user_instance_with_uuid_and_hashed_password(
        UuidService $uuidService,
        UserPasswordHasherInterface $userPasswordHasher
    ): void
    {
        $email = 'test@test.com';
        $plainPassword = 'password';
        $username = 'username';

        /* Mock uuid generation */
        $uuid = new Uuid('550e8400-e29b-41d4-a716-446655440000');
        $uuidService->generateUuid()->willReturn($uuid);

        /* Mock hashed password generation */
        $hashedPassword = '$2y$13$53keLz8UHiA2/94nX2avcuxBFeJ92aOMRap5Y96CmNbplU6/8pSrO';
        $userPasswordHasher->hashPassword(
            Argument::type(User::class),
            $plainPassword
        )->willReturn($hashedPassword);

        $user = $this->getUserInstance($email, $plainPassword, $username);

        $user->shouldBeAnInstanceOf(User::class);
        $user->getUuid()->shouldBe($uuid);
        $user->getEmail()->shouldBe($email);
        $user->getUsername()->shouldBe($username);
        $user->getHashedPassword()->shouldBe($hashedPassword);
    }
}
