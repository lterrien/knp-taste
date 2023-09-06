<?php

namespace App\Service;

use Symfony\Component\Uid\Factory\UuidFactory;
use Symfony\Component\Uid\Uuid;

class UuidService
{
    public function __construct(private UuidFactory $uuidFactory) {
    }

    /**
     * Generate a new uuid
     * @return Uuid
     */
    public function generateUuid(): Uuid
    {
        return $this->uuidFactory->create();
    }
}
