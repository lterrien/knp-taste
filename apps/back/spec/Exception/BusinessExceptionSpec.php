<?php

namespace spec\App\Exception;

use App\Exception\BusinessException;
use App\Exception\ErrorCode\BusinessError;
use PhpSpec\ObjectBehavior;

class BusinessExceptionSpec extends ObjectBehavior
{
    function it_is_initializable(): void
    {
        $this->shouldHaveType(BusinessException::class);
    }

    /* Test function addError */

    function it_can_add_an_error_code(): void
    {
        $errorCode = BusinessError::InvalidPassword;
        $this->addError($errorCode)->shouldReturn([$errorCode]);
    }

    function it_does_not_add_duplicate_error_code(): void
    {
        $errorCode = BusinessError::InvalidPassword;
        $this->addError($errorCode);
        $this->addError($errorCode)->shouldReturn([$errorCode]);
    }

    /* Test function hasErrors */

    function it_can_check_it_has_no_error(): void
    {
        $this->hasErrors()->shouldReturn(false);
    }

    function it_can_check_it_has_errors(): void
    {
        $errorCode = BusinessError::InvalidPassword;
        $this->addError($errorCode);
        $this->hasErrors()->shouldReturn(true);
    }
}
