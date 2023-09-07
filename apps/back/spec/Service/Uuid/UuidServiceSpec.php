<?php

namespace spec\App\Service\Uuid;

use App\Service\Uuid\UuidService;
use PhpSpec\ObjectBehavior;
use Symfony\Component\Uid\Factory\UuidFactory;
use Symfony\Component\Uid\Uuid;

class UuidServiceSpec extends ObjectBehavior
{
    function let(UuidFactory $uuidFactory): void
    {
        $this->beConstructedWith($uuidFactory);
    }

    function it_is_initializable(): void
    {
        $this->shouldHaveType(UuidService::class);
    }

    function it_generates_a_uuid(UuidFactory $uuidFactory, Uuid $uuid): void
    {
        $uuidFactory->create()->willReturn($uuid);
        $this->generateUuid()->shouldReturn($uuid);
    }
}
