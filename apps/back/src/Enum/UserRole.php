<?php

namespace App\Enum;

enum UserRole: string
{
    case RoleUser = 'ROLE_USER';
    case RoleAdmin = 'ROLE_ADMIN';
}
