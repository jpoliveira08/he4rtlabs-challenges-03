<?php

declare(strict_types=1);

namespace App\Models\Credentials;

use DomainException;
use PDO;

/**
 * Wrapping the email
 */
class Email
{
    private $email;

    public function __construct(string $email)
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

    /**
     * Check if the email exists in database
     *
     * @param Email $email
     * @return array
     */
    public function emailExists(PDO $connection): array
    {
        $query = 'SELECT * FROM users WHERE email = :email';
        $stmt = $connection->prepare($query);
        $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
        $stmt->execute();
        $rowWithUserData = $stmt->fetch(PDO::FETCH_ASSOC);

        return !$rowWithUserData ? [] : $rowWithUserData;
    }
}