<?php

declare(strict_types=1);

namespace App\Models;

use Core\Model;

use PDO;

class User extends Model
{
    private PDO $connection;
    private Validation $validation;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
        $this->validation = new Validation($this->connection);
    }
    
    public function authenticateUser(Email $email, string $password): bool
    {
        $this->validation->isPasswordCommon($password);
        $data = $this->validation->emailExists($email);

        if (empty($data) || !password_verify($password, $data['password'])) {
            return false;
        }

        return true;
    }
    
    public function createUser(Email $email, string $password): array
    {
        if (!empty($this->validation->emailExists($email))) {
            return [
                'success' => false,
                'errorCause' => 'email'
            ];
        }

        if ($this->validation->isPasswordCommon($password)) {
            return [
                'success' => false,
                'errorCause' => 'password'
            ];
        }
        $id = $this->generateUid();
        $password = $this->hashPassword($password);

        $query = "INSERT INTO users (id, email, password) VALUES (:id, :email, :password)";
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':password', $password, PDO::PARAM_STR);
        $stmt->execute();

        return [
            'success' => true
        ];
    }

    private function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    private function generateUid(): string
    {
        return uniqid();
    }
}
