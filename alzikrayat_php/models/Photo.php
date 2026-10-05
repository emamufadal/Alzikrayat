<?php

// Provides database operations related to photos.
class Photo extends Model
{
// Return all photos with their authors, newest first.
    public function all(): array
    {
        return $this->db
            ->query(
                'SELECT p.*, CONCAT(u.first_name, " ", u.last_name) author_name '
                . 'FROM photos p '
                . 'JOIN users u ON u.id = p.user_id '
                . 'ORDER BY p.date_time DESC'
            )
            ->fetchAll();
    }

// Find one photo by its ID together with its author.
    public function find(int $id): ?array
    {
        $statement = $this->db->prepare(
            'SELECT p.*, CONCAT(u.first_name, " ", u.last_name) author_name '
            . 'FROM photos p '
            . 'JOIN users u ON u.id = p.user_id '
            . 'WHERE p.id = :id LIMIT 1'
        );
        $statement->execute(['id' => $id]);

        return $statement->fetch() ?: null;
    }

// Insert a new photo record into the database.
    public function create(array $data): int
    {
        $statement = $this->db->prepare(
            'INSERT INTO photos (user_id, file_name, title, description) '
            . 'VALUES (:user_id, :file_name, :title, :description)'
        );
        $statement->execute($data);

        return (int) $this->db->lastInsertId();
    }

// Delete a photo only when it belongs to the specified user.
    public function deleteOwned(int $id, int $userId): ?string
    {
        $statement = $this->db->prepare(
            'SELECT file_name FROM photos '
            . 'WHERE id = :id AND user_id = :user_id'
        );
        $statement->execute([
            'id' => $id,
            'user_id' => $userId,
        ]);

        $photo = $statement->fetch();

// Stop deletion when the requested photo is not owned by the user.
        if (!$photo) {
            return null;
        }

        $delete = $this->db->prepare(
            'DELETE FROM photos WHERE id = :id AND user_id = :user_id'
        );
        $delete->execute([
            'id' => $id,
            'user_id' => $userId,
        ]);

        return $photo['file_name'];
    }
}
