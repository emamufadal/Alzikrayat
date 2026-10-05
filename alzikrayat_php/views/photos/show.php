<?php

// Set the page title from the selected photo and load the shared header.
$pageTitle = $photo['title'];
require __DIR__ . '/../layout/header.php';

?>

    <!-- Display the selected photo together with its details. -->
<div class="row g-4">
    <div class="col-lg-8">
        <img
            src="<?= APP_BASE_URL ?>/images/uploads/<?= e($photo['file_name']) ?>"
            class="img-fluid rounded shadow-sm detail-image"
            alt="<?= e($photo['title']) ?>"
        >
    </div>

    <div class="col-lg-4">
        <h1><?= e($photo['title']) ?></h1>

        <p class="text-muted">
            By <?= e($photo['author_name']) ?> · <?= e($photo['date_time']) ?>
        </p>

        <p><?= nl2br(e($photo['description'])) ?></p>

<!-- Show the delete action only to the photo owner. -->
        <?php if (!empty($_SESSION['user_id']) && $_SESSION['user_id'] == $photo['user_id']): ?>
            <a
                class="btn btn-outline-danger"
                href="<?= APP_BASE_URL ?>/photo/<?= intval($photo['id']) ?>/delete"
                onclick="return confirm('Delete this photo?')"
            >
                Delete Photo
            </a>
        <?php endif; ?>
    </div>
</div>

<hr class="my-5">

    <!-- Start the comments section for the selected photo. -->
<h2>Comments</h2>

<!-- Display each stored comment with its author and timestamp. -->
<?php foreach ($comments as $comment): ?>
    <div class="comment mb-3 p-3 rounded border">
        <strong><?= e($comment['author_name']) ?></strong>
        <small class="text-muted">
            <?= e($comment['date_time']) ?>
        </small>

        <div>
            <?= nl2br(e($comment['comment'])) ?>
        </div>
    </div>
<?php endforeach; ?>

<!-- Show the comment form only to logged-in users. -->
<?php if (!empty($_SESSION['user_id'])): ?>
    <form
        method="post"
        action="<?= APP_BASE_URL ?>/comment/store"
        class="mt-4"
    >
        <input
            type="hidden"
            name="photo_id"
            value="<?= intval($photo['id']) ?>"
        >

        <textarea
            class="form-control mb-3"
            name="comment"
            maxlength="1000"
            rows="3"
            required
            placeholder="Write a comment..."
        ></textarea>

        <button class="btn btn-primary">
            Add Comment
        </button>
    </form>
<?php else: ?>
    <p>
        <a href="<?= APP_BASE_URL ?>/login">Login</a>
        to add a comment.
    </p>
<?php endif; ?>

<!-- Load the shared footer after the photo details. -->
<?php require __DIR__ . '/../layout/footer.php'; ?>
