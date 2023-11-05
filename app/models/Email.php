<?php

namespace app\models;

use PDO;

class Email
{
    public function __construct(private PDO $connection) {}

    public function setEmail(string $email, bool $verified, string $url = null): void
    {
        $query = 'INSERT INTO tmp_emails (email, verified, url) VALUES (?, ?, ?)';
        $statement = $this->connection->prepare($query);

        if (!$statement) {
            error_log('Failed to prepare statement');
            return;
        }

        $statement->execute([$email, $verified, $url]);
    }

    public function setVerified(string $email, bool $verified, string $url): void
    {
        $query = 'UPDATE tmp_emails SET verified = ?, url = ? WHERE email = ? AND url = ?';
        $statement = $this->connection->prepare($query);

        if (!$statement) {
            error_log('Failed to prepare statement');
            return;
        }

        $statement->execute([$verified, null, $email, $url]);
    }

    public function getEmailByURL($url): ?array
    {
        $query = 'SELECT * FROM tmp_emails WHERE url = ?';
        $statement = $this->connection->prepare($query);

        if (!$statement) {
            error_log('Failed to prepare statement');
            return null;
        }

        $statement->execute([$url]);

        $email = $statement->fetch(PDO::FETCH_ASSOC);

        return $email ?: null;
    }

    public function getEmail($email): ?array
    {
        $query = 'SELECT * FROM tmp_emails WHERE email = ?';
        $statement = $this->connection->prepare($query);

        if (!$statement) {
            error_log('Failed to prepare statement');
            return null;
        }

        $statement->execute([$email]);

        $email = $statement->fetch(PDO::FETCH_ASSOC);

        return $email ?: null;
    }

    public function isVerified($email): ?bool
    {
        $query = 'SELECT verified FROM tmp_emails WHERE email = ?';
        $statement = $this->connection->prepare($query);

        if (!$statement) {
            error_log('Failed to prepare statement');
            return null;
        }

        $statement->execute([$email]);

        $email = $statement->fetch(PDO::FETCH_ASSOC);

        $verified = $email['verified'];

        return $verified ?: false;
    }

    public function deleteEmail($email): void
    {
        $query = 'DELETE FROM tmp_emails WHERE email=?';
        $statement = $this->connection->prepare($query);

        if (!$statement) {
            error_log('Failed to prepare statement');
            return;
        }

        $statement->execute([$email]);
    }
}