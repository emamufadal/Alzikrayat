<?php

// Provides database operations related to photo comments.
class Comment extends Model
{
// Fetch all comments for a photo in chronological order.
    public function forPhoto(int $photoId): array
    {
        $statement = $this->db->prepare(
            'SELECT c.*, CONCAT(u.first_name, " ", u.last_name) author_name '
            . 'FROM comments c '
            . 'JOIN users u ON u.id = c.user_id '
            . 'WHERE c.photo_id = :photo_id '
            . 'ORDER BY c.date_time ASC'
        );
        $statement->execute(['photo_id' => $photoId]);

        return $statement->fetchAll();
    }

// Insert a new comment into the database.
    public function create(array $data): int
    {
        $statement = $this->db->prepare(
            'INSERT INTO comments (photo_id, user_id, comment) '
            . 'VALUES (:photo_id, :user_id, :comment)'
        );
        $statement->execute($data);

        return (int) $this->db->lastInsertId();
    }
}
