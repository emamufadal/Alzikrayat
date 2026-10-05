<?php

// Set the page title and load the shared header.
$pageTitle = 'Gallery';
require __DIR__ . '/../layout/header.php';

?>

    <!-- Display the gallery heading and add-photo action. -->
<div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
    <div>
        <h1>Photo Gallery</h1>
        <p class="text-muted mb-0">
            Share moments and discover memories.
        </p>
    </div>

    <?php if (!empty($_SESSION['user_id'])): ?>
        <a
            href="<?= APP_BASE_URL ?>/photo/create"
            class="btn btn-primary"
        >
            + Add Photo
        </a>
    <?php endif; ?>
</div>

<!-- Show an empty-state message when no photos are available. -->
<?php if (!$photos): ?>
    <div class="empty-state text-center p-5">
        <h3>No photos yet</h3>
        <p>Be the first to share a memory.</p>
    </div>
<?php else: ?>

    <!-- Provide controls for changing the gallery display style. -->
    <div class="gallery-toolbar bg-white border rounded-3 p-3 mb-4 shadow-sm">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
            <div>
                <strong>Gallery Style</strong>
                <span class="text-muted small ms-2">
                    Choose how your memories are displayed
                </span>
            </div>

            <div
                class="btn-group"
                role="group"
                aria-label="Gallery display styles"
            >
                <button
                    type="button"
                    class="btn btn-outline-primary gallery-style-btn active"
                    data-gallery-style="three"
                >
                    3 Columns
                </button>

                <button
                    type="button"
                    class="btn btn-outline-primary gallery-style-btn"
                    data-gallery-style="four"
                >
                    4 Columns
                </button>

                <button
                    type="button"
                    class="btn btn-outline-primary gallery-style-btn"
                    data-gallery-style="list"
                >
                    List
                </button>

                <button
                    type="button"
                    class="btn btn-outline-primary gallery-style-btn"
                    data-gallery-style="full"
                >
                    Full Width
                </button>
            </div>
        </div>
    </div>

    <!-- Render the responsive photo gallery. -->
    <div
        id="photoGallery"
        class="row g-4 gallery-grid gallery-style-three"
    >
<!-- Render each photo and its metadata. -->
        <?php foreach ($photos as $photo): ?>
            <div class="gallery-item col-sm-6 col-lg-4">
                <div class="card h-100 shadow-sm photo-card">
                    <img
                        src="<?= APP_BASE_URL ?>/images/uploads/<?= e($photo['file_name']) ?>"
                        class="card-img-top gallery-image"
                        alt="<?= e($photo['title']) ?>"
                    >

                    <div class="card-body">
                        <h5><?= e($photo['title']) ?></h5>

                        <p class="text-muted small">
                            By <?= e($photo['author_name']) ?>
                            · <?= e($photo['date_time']) ?>
                        </p>

                        <p><?= e($photo['description']) ?></p>

                        <a
                            href="<?= APP_BASE_URL ?>/photo/<?= intval($photo['id']) ?>"
                            class="btn btn-outline-primary btn-sm"
                        >
                            View Details
                        </a>

                        <?php if (!empty($_SESSION['user_id']) && $_SESSION['user_id'] == $photo['user_id']): ?>
                            <a
                                href="<?= APP_BASE_URL ?>/photo/<?= intval($photo['id']) ?>/delete"
                                class="btn btn-outline-danger btn-sm"
                                onclick="return confirm('Delete this photo?')"
                            >
                                Delete
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<!-- Load the shared footer after the gallery. -->
<?php require __DIR__ . '/../layout/footer.php'; ?>
