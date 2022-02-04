<?php

declare (strict_types=1);

namespace App\Models;

use Core\Model;

use PDO;

class User extends Model
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function authenticateUser(string $email, string $password): bool
    {

        $query = 'SELECT * FROM users WHERE email = :email AND password = :password;';
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':password', $password. PDO::PARAM_STR);
        
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            return true;
        }
        return false;
    }
    
    public function createUser(string $email, string $password): bool
    {
        $id = $this->generateUid();
        $password = $this->hashPassword($password);

        $query = "INSERT INTO users (id, email, password) VALUES (:id, :email, :password)";
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':password', $password, PDO::PARAM_STR);
        
        return $stmt->execute();
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