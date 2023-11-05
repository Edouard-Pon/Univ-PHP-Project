<?php

namespace app\models;

use PDO;

class User
{
    public function __construct(private PDO $connection) {}

    public function getUser(string $username, string $password): ?array
    {
        $query = 'SELECT * FROM user WHERE username = ? AND password = ?';
        $statement = $this->connection->prepare($query);
        if (!$statement) {
            error_log('Failed to prepare statement');
            return null;
        }

        $statement->execute([$username, $password]);
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        return $user ?: null;
    }

    public function setUser($data): void
    {
        $query = 'INSERT INTO user (username, nickname, password, email, number, location, gender, firstco) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())';
        $statement = $this->connection->prepare($query);
        if (!$statement) {
            error_log('Failed to prepare statement');
            return;
        }
        $statement->execute(array($data['username'], $data['nickname'], $data['password'], $data['email'], $data['number'], $data['location'], $data['gender']));
    }

    public function setLastConnection(): void
    {
        $query = 'UPDATE user SET lastco = NOW() WHERE id = ?';
        $statement = $this->connection->prepare($query);
        if (!$statement) {
            error_log('Failed to prepare statement');
            return;
        }
        $statement->execute([$_SESSION['id']]);
    }

    public function isAdmin(): bool
    {
        return $_SESSION['admin'] ?? false;
    }

    public function update($data): void
    {
        $query = 'UPDATE user SET username = ?, profile_picture = ? WHERE username = ? AND password = ?';
        $statement = $this->connection->prepare($query);
        if (!$statement) {
            error_log('Failed to prepare statement');
            return;
        }
        $statement->execute(array($data['username'], $data['filePath'], $_SESSION['username'], $_SESSION['password']));
    }

    public function getUserPublic(string $username)
    {
        $query = 'SELECT username, nickname, gender, location, lastco, firstco, profile_picture FROM user WHERE username = ?';
        $statement = $this->connection->prepare($query);
        if (!$statement) {
            error_log('Failed to prepare statement');
            return null;
        }

        $statement->execute([$username]);
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        return $user ?: null;
    }

    public function isUserEmailExist(string $email): ?bool
    {
        $query = 'SELECT email FROM user WHERE email = ?';
        $statement = $this->connection->prepare($query);

        if (!$statement) {
            error_log('Failed to prepare statement');
            return null;
        }

        $statement->execute([$email]);

        $emailData = $statement->fetch(PDO::FETCH_ASSOC);

        if (isset($emailData['email']) && $emailData['email'] === $email) return true;
        return false;
    }

    public function isUsernameExist(string $username): ?bool
    {
        $query = 'SELECT username FROM user WHERE username = ?';
        $statement = $this->connection->prepare($query);

        if (!$statement) {
            error_log('Failed to prepare statement');
            return null;
        }

        $statement->execute([$username]);

        $usernameData = $statement->fetch(PDO::FETCH_ASSOC);

        if (isset($usernameData['username']) && $usernameData['username'] === $username) return true;
        return false;
    }
}
