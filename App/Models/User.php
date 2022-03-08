<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Credentials\{Email, Password};
use Core\Model;
use PDO;

class User extends Model
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = self::connectionCreator();
    }

    /**
     * User authentication
     *
     * @param Email $email
     * @param Password $password
     * @return boolean
     */
    public function authenticateUser(Email $email, Password $password): bool
    {
        $data = $email->emailExists($this->connection);

        if (empty($data) || !password_verify($password->withoutHash(), $data['password'])) {
            return false;
        }

        return true;
    }

    /**
     * User Registration
     *
     * @param Email $email
     * @param Password $password
     * @return array
     */
    public function createUser(Email $email, Password $password): array
    {
        if ($email->emailExists($this->connection)) {
            return ['errorCause' => 'email'];
        }

        if ($password->isCommon()) {
            return ['errorCause' => 'password'];
        }

        $id = $this->generateUid();
        $password = $password->withHash();

        $query = "INSERT INTO users (id, email, password) VALUES (:id, :email, :password)";
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':password', $password, PDO::PARAM_STR);
        $stmt->execute();

        return [];
    }

    /**
     * Generating a unique id for each user
     *
     * @return string
     */
    private function generateUid(): string
    {
        return uniqid();
    }
}
