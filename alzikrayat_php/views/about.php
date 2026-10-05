<?php

// Set the page title and load the shared header.
$pageTitle = 'About Us';
require __DIR__ . '/layout/header.php';

?>

    <!-- Explain the purpose and main technical features of the application. -->
<div class="card shadow-sm p-4">
    <h1>About Alzikrayat</h1>

    <p>
        Alzikrayat is an MVC-based photo sharing application created for an
        Advanced Web Technologies course project.
    </p>

    <p>
        It demonstrates custom PHP MVC architecture, three-tier separation,
        manual regular-expression routing, secure sessions, password hashing,
        raw parameterized PDO queries, photo management, and commenting.
    </p>
</div>

<!-- Load the shared footer after the page content. -->
<?php require __DIR__ . '/layout/footer.php'; ?>
