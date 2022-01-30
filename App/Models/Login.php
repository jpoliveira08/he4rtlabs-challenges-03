<?php

namespace App\Models;

use Core\Model;
use PDO;

class Login extends Model
{
    private PDO $connection;
    private string $email;
    private string $password;

    //I need to create a way to check if the user exist
    public function __construct(array $userCredentials)
    {
        $this->email = filter_var($userCredentials['email'], FILTER_SANITIZE_EMAIL);
        $this->password = $userCredentials['password'];
        $this->connection = Model::connectionCreator();
    }

    public function makeLogin(): bool
    {
        if (!$this->emailExists($this->email) || !$this->checkUserCredentials($this->email, $this->password)) {
            return false;
        }
        return true;
    }

    private function emailExists(): bool
    {
        $sqlQuery = 'SELECT * FROM users WHERE email = :email';
        $stmt = $this->connection->prepare($sqlQuery);
        $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
        $stmt->execute();
        if ($stmt->rowCount() === 0) {
            return false;
        }
        return true;
    }

    private function checkUserCredentials(string $email, string $password): bool
    {
        return true;
    }
}