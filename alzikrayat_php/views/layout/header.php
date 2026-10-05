<?php

// Escape dynamic output before placing it into HTML.
function e(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

?>
<!-- Start the shared HTML document structure. -->
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($pageTitle ?? 'Alzikrayat') ?></title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
    <link
        href="<?= APP_BASE_URL ?>/assets/css/app.css"
        rel="stylesheet"
    >
</head>
<body>

    <!-- Render the shared navigation bar. -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="<?= APP_BASE_URL ?>/">
            Alzikrayat
        </a>

        <button
            class="navbar-toggler"
            data-bs-toggle="collapse"
            data-bs-target="#nav"
        >
            ☰
        </button>

        <div id="nav" class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                <li>
                    <a class="nav-link" href="<?= APP_BASE_URL ?>/photos">
                        Gallery
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="<?= APP_BASE_URL ?>/about">
                        About Us
                    </a>
                </li>

                <!-- Show authenticated navigation options when a user is logged in. -->
                <?php if (!empty($_SESSION['user_id'])): ?>
                    <li>
                        <span class="nav-link">
                            Hi <?= e($_SESSION['first_name']) ?>
                        </span>
                    </li>
                    <li>
                        <a
                            class="btn btn-outline-light btn-sm"
                            href="<?= APP_BASE_URL ?>/logout"
                        >
                            Logout
                        </a>
                    </li>
                <?php else: ?>
                    <li>
                        <a class="nav-link" href="<?= APP_BASE_URL ?>/login">
                            Please Login
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

    <!-- Open the shared main content container. -->
<main class="container py-4">
