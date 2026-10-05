<?php

// Set the page title and load the shared header.
$pageTitle = 'Home';
require __DIR__ . '/layout/header.php';

?>

    <!-- Display the main introduction and call-to-action section. -->
<section class="hero p-5 rounded-4 mb-5">
    <div class="row align-items-center">
        <div class="col-lg-7">
            <span class="badge text-bg-primary mb-3">
                Photo Sharing • MVC • PHP
            </span>

            <h1 class="display-4 fw-bold">
                Your memories deserve a place.
            </h1>

            <p class="lead">
                Alzikrayat is a photo-sharing space for preserving moments,
                sharing stories, and interacting through comments.
            </p>

            <a
                href="<?= APP_BASE_URL ?>/photos"
                class="btn btn-primary btn-lg"
            >
                Explore Gallery
            </a>

            <?php if (empty($_SESSION['user_id'])): ?>
                <a
                    href="<?= APP_BASE_URL ?>/register"
                    class="btn btn-outline-dark btn-lg ms-2"
                >
                    Join Alzikrayat
                </a>
            <?php endif; ?>
        </div>

        <div class="col-lg-5 text-center">
            <div class="hero-icon">📷</div>
        </div>
    </div>
</section>

    <!-- Present the three main application features. -->
<div class="row g-4">
    <div class="col-md-4">
        <div class="card h-100 p-4">
            <h3>Share</h3>
            <p>Upload photos with a title and story.</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card h-100 p-4">
            <h3>Discover</h3>
            <p>Browse a responsive gallery.</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card h-100 p-4">
            <h3>Connect</h3>
            <p>Comment on other memories.</p>
        </div>
    </div>
</div>

<!-- Load the shared footer after the page content. -->
<?php require __DIR__ . '/layout/footer.php'; ?>
