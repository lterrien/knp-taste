<?php

namespace App\Service\Uuid;

use Symfony\Component\Uid\Uuid;

interface UuidServiceInterface
{
    public function generateUuid(): Uuid;
}
