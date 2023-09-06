<?php

namespace App\Exception;

use App\Exception\ErrorCode\BusinessError;
use Exception;

class BusinessException extends Exception
{
    private array $errors = [];

    /**
     * Add a new error code in errors list
     * @param BusinessError $errorCode
     * @return array: errors list
     */
    public function addError(BusinessError $errorCode): array
    {
        // Add error if it is not already in errors list
        if (!in_array($errorCode, $this->errors, true)) {
            $this->errors[] = $errorCode;
        }
        return $this->errors;
    }

    /**
     * Check if errors list contains errors
     * @return bool
     */
    public function hasErrors(): bool
    {
        return count($this->errors) > 0;
    }

    /**
     * Get errors list
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
