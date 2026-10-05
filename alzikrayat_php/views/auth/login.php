<?php

// Set the page title and load the shared header.
$pageTitle = 'Login';
require __DIR__ . '/../layout/header.php';

?>

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h2>Welcome Back</h2>

<!-- Display the previous login time when it is available. -->
                <?php if (!empty($lastLogin)): ?>
                    <div class="alert alert-info">
                        Last login from this computer was <?= e($lastLogin) ?>
                    </div>
                <?php endif; ?>

<!-- Show a success message after registration. -->
                <?php if (!empty($_GET['registered'])): ?>
                    <div class="alert alert-success">
                        Registration successful. Please log in.
                    </div>
                <?php endif; ?>

<!-- Display authentication errors returned by the controller. -->
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php foreach ($errors as $error): ?>
                                <li><?= e($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

    <!-- Collect the email and password used for login. -->
                <form
                    method="post"
                    action="<?= APP_BASE_URL ?>/login"
                >
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input
                            class="form-control"
                            type="email"
                            name="email"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input
                            class="form-control"
                            type="password"
                            name="password"
                            minlength="8"
                            required
                        >
                    </div>

                    <button class="btn btn-primary w-100">
                        Login
                    </button>
                </form>

                <p class="mt-3 mb-0">
                    New here?
                    <a href="<?= APP_BASE_URL ?>/register">
                        Create an account
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Load the shared footer after the form. -->
<?php require __DIR__ . '/../layout/footer.php'; ?>
