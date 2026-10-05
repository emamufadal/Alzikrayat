<?php

// Set the page title and load the shared header.
$pageTitle = 'Register';
require __DIR__ . '/../layout/header.php';

?>

<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h2>Create Account</h2>

<!-- Show server-side validation errors when registration fails. -->
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li><?= e($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

    <!-- Collect the user information required to create an account. -->
                <form
                    method="post"
                    action="<?= APP_BASE_URL ?>/register"
                    id="registerForm"
                >
    <!-- Group the first and last name fields together. -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">First Name</label>
                            <input
                                class="form-control"
                                name="first_name"
                                pattern="[A-Za-z]{1,50}"
                                required
                            >
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Last Name</label>
                            <input
                                class="form-control"
                                name="last_name"
                                pattern="[A-Za-z]{1,50}"
                                required
                            >
                        </div>
                    </div>

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

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Occupation</label>
                            <input
                                class="form-control"
                                name="occupation"
                                maxlength="100"
                            >
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Location</label>
                            <input
                                class="form-control"
                                name="location"
                                maxlength="100"
                            >
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea
                            class="form-control"
                            name="description"
                            rows="3"
                        ></textarea>
                    </div>

    <!-- Submit the registration form. -->
                    <button class="btn btn-primary">
                        Register
                    </button>

                    <a
                        href="<?= APP_BASE_URL ?>/login"
                        class="btn btn-link"
                    >
                        Already registered?
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Load the shared footer after the form. -->
<?php require __DIR__ . '/../layout/footer.php'; ?>
