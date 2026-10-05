<?php

// Set the page title and load the shared header.
$pageTitle = 'Add Photo';
require __DIR__ . '/../layout/header.php';

?>

<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h2>Share a New Memory</h2>

<!-- Show upload validation errors returned by the controller. -->
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li><?= e($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

    <!-- Collect the title, description, and image file for a new memory. -->
                <form
                    method="post"
                    action="<?= APP_BASE_URL ?>/photo/store"
                    enctype="multipart/form-data"
                    id="photoForm"
                >
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input
                            class="form-control"
                            name="title"
                            maxlength="200"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea
                            class="form-control"
                            name="description"
                            rows="4"
                        ></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Image</label>
    <!-- Provide the image file selector with allowed image types. -->
                        <input
                            class="form-control"
                            type="file"
                            name="image"
                            accept="image/jpeg,image/png,image/gif,image/webp"
                            required
                        >
                    </div>

                    <button class="btn btn-primary">
                        Upload Photo
                    </button>

                    <a
                        class="btn btn-link"
                        href="<?= APP_BASE_URL ?>/photos"
                    >
                        Cancel
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Load the shared footer after the upload form. -->
<?php require __DIR__ . '/../layout/footer.php'; ?>
