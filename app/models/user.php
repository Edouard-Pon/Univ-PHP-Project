<?php
class User
{
    public function __construct(private PDO $connection) {}

    public function getUser(string $username, string $password): ?array
    {
        $query = 'SELECT * FROM user WHERE name = ? AND password = ?';
        $statement = $this->connection->prepare($query);
        if (!$statement) {
            error_log('Failed to prepare statement');
            return null;
        }

        $statement->execute([$username, $password]);
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        return $user ?: null;
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
}
