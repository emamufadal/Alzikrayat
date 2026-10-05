<?php

// Provides database operations related to users.
class User extends Model
{
// Find one user by email for registration checks and login.
    public function findByEmail(string $email): ?array
    {
        $statement = $this->db->prepare(
            'SELECT * FROM users WHERE email = :email LIMIT 1'
        );
        $statement->execute(['email' => $email]);

        return $statement->fetch() ?: null;
    }

// Insert a new user into the database.
    public function create(array $data): int
    {
        $statement = $this->db->prepare(
            'INSERT INTO users '
            . '(first_name, last_name, email, password, location, description, occupation) '
            . 'VALUES (:first_name, :last_name, :email, :password, :location, :description, :occupation)'
        );
        $statement->execute($data);

        return (int) $this->db->lastInsertId();
    }
}
