<?php

declare(strict_types=1);

namespace App\Models;

use PDO;

/**
 * Validation information before register and login
 */
class Validation
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Check if the email exists in database
     *
     * @param Email $email
     * @return array
     */
    public function emailExists(Email $email): array
    {
        $query = 'SELECT * FROM users WHERE email = :email';
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);

        $stmt->execute();

        $rowWithUserData = $stmt->fetch(PDO::FETCH_ASSOC);

        return !$rowWithUserData ? [] : $rowWithUserData;
    }

    /**
     * Check if the password is on the 1000 common password list's
     *
     * @param string $password
     * @return boolean
     */
    public function isPasswordCommon(string $password): bool
    {
        $archive = fopen('common_passwords.txt', 'r');
        while (!feof($archive)) {
            $passwordFromTheList = fgets($archive);
            if ($passwordFromTheList === $password) {
                return true;
            }
        }

        return false;
    }


}