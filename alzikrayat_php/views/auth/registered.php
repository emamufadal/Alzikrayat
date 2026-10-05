<?php

// Set the page title and load the shared header.
$pageTitle = 'Registered';
require __DIR__ . '/../layout/header.php';

?>

    <!-- Confirm that the account was created successfully. -->
<div class="alert alert-success text-center p-5">
    <h2>Account created successfully.</h2>
    <p>You can now log in and start sharing memories.</p>

    <a href="<?= APP_BASE_URL ?>/login" class="btn btn-primary">
        Go to Login
    </a>
</div>

<!-- Load the shared footer after the confirmation message. -->
<?php require __DIR__ . '/../layout/footer.php'; ?>
