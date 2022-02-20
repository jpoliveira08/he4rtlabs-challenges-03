<?php

declare(strict_types=1);

namespace App\Models;

use DomainException;

/**
 * Wrapping the email
 */
class Email
{
    private $email;

    public function __construct($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new DomainException('Invalid email address');
        }
        $this->email = $email;
    }

    public function __toString(): string
    {
        return $this->email;
    }
}