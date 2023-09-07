<?php

namespace App\Service;

use Symfony\Component\Uid\Factory\UuidFactory;
use Symfony\Component\Uid\Uuid;

class UuidService
{
    public function __construct(private readonly UuidFactory $uuidFactory) {
    }

    /**
     * @return Uuid
     */
    public function generateUuid(): Uuid
    {
        return $this->uuidFactory->create();
    }
}
