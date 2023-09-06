<?php

namespace App\Exception\ErrorCode;

enum BusinessError: int
{
    /* User errors: 10000 */
    case InvalidPassword = 10001;
    case InvalidUsername = 10002;
    case InvalidEmail = 10003;
    case InvalidRoles = 10004;
}
