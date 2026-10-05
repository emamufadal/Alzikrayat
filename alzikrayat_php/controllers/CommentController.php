<?php

// Handles creating comments for photos.
class CommentController extends Controller
{
// Validate the current user, photo, and comment before saving it.
    public function store(): void
    {
        if (empty($_SESSION['user_id'])) {
            $this->redirect('/login');
        }

// Convert the submitted photo ID into a validated integer.
        $photoId = filter_var(
            $_POST['photo_id'] ?? null,
            FILTER_VALIDATE_INT
        );
        $comment = trim($_POST['comment'] ?? '');

// Reject missing or oversized comments and invalid photo IDs.
        if (!$photoId || $comment === '' || mb_strlen($comment) > 1000) {
            $this->redirect('/photo/' . (int) $photoId);
        }

// Make sure the target photo exists before creating the comment.
        if (!(new Photo())->find($photoId)) {
            $this->redirect('/photos');
        }

// Save the new comment in the database.
        (new Comment())->create([
            'photo_id' => $photoId,
            'user_id' => $_SESSION['user_id'],
            'comment' => $comment,
        ]);

        $this->redirect('/photo/' . $photoId);
    }
}
