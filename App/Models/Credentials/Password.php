<?php

declare(strict_types=1);

namespace App\Models\Credentials;

use DomainException;
use SplFileObject;

class Password
{
    public string $password;

    public function __construct(string $password)
    {
        if (empty($password)) {
            throw new DomainException("Password cannot be empty");
        }
        $this->password = $password;
    }

    /**
     * Get password without hashing
     *
     * @return string
     */
    public function withoutHash(): string
    {
        return $this->password;
    }

    /**
     * Hashing the password before insert into the database
     *
     * @return string
     */
    public function withHash(): string
    {
        return password_hash($this->password, PASSWORD_BCRYPT);
    }

    /**
     * Check if the password is on the 1000 common password list's
     *
     * @return boolean
     */
    public function isCommon(): bool
    {
        $commonsPasswords = new SplFileObject(__DIR__ . '/../common_passwords.txt');
        foreach ($commonsPasswords as $commonPassword) {
            if (trim($commonPassword) === $this->password) {
                return true;
            }
        }
        return false;
    }
}
