<?php

// Set the page title and load the shared header.
$pageTitle = '404';
require __DIR__ . '/header.php';

?>

    <!-- Display the not-found message and a link back home. -->
<div class="text-center py-5">
    <h1 class="display-4">404</h1>
    <p class="lead">The requested page could not be found.</p>

    <a href="<?= APP_BASE_URL ?>/" class="btn btn-primary">
        Back Home
    </a>
</div>

<!-- Load the shared footer after the error page. -->
<?php require __DIR__ . '/footer.php'; ?>
