<?php

// Handles photo listing, viewing, uploading, and deletion.
class PhotoController extends Controller
{
// Make sure only authenticated users can access protected actions.
    private function requireLogin(): void
    {
        if (empty($_SESSION['user_id'])) {
            $this->redirect('/login');
        }
    }

// Load all photos and pass them to the gallery view.
    public function index(): void
    {
        $this->render('photos/index', [
            'photos' => (new Photo())->all(),
        ]);
    }

// Validate the photo ID and load the selected photo and its comments.
    public function show(string $id): void
    {
        $id = filter_var($id, FILTER_VALIDATE_INT);
        $photo = $id ? (new Photo())->find($id) : null;

// Show the 404 page when the requested photo does not exist.
        if (!$photo) {
            http_response_code(404);
            require __DIR__ . '/../views/layout/404.php';
            return;
        }

        $this->render('photos/show', [
            'photo' => $photo,
            'comments' => (new Comment())->forPhoto($id),
        ]);
    }

// Show the form used to upload a new photo.
    public function create(): void
    {
        $this->requireLogin();
        $this->render('photos/create');
    }

// Validate the upload, save the image file, and create the database record.
    public function store(): void
    {
        $this->requireLogin();

        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $errors = [];

        if ($title === '' || mb_strlen($title) > 200) {
            $errors[] = 'Title is required and must not exceed 200 characters.';
        }

        if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
            $errors[] = 'Please choose a valid image.';
        }

// Map allowed MIME types to safe file extensions.
        $types = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/gif' => 'gif',
            'image/webp' => 'webp',
        ];
        $ext = null;

// Only inspect the uploaded file when previous validation has passed.
        if (!$errors) {
            $mime = (new finfo(FILEINFO_MIME_TYPE))->file(
                $_FILES['image']['tmp_name']
            );

            $ext = $types[$mime] ?? null;

            if (!$ext) {
                $errors[] = 'Only JPG, PNG, GIF, and WEBP images are allowed.';
            }

            if ($_FILES['image']['size'] > 5242880) {
                $errors[] = 'Image size must be 5MB or less.';
            }
        }

        if ($errors) {
            $this->render('photos/create', [
                'errors' => $errors,
            ]);
            return;
        }

// Generate a random file name to avoid collisions and unsafe original names.
        $name = bin2hex(random_bytes(16)) . '.' . $ext;
        $target = __DIR__ . '/../public/images/uploads/' . $name;

// Move the validated uploaded image into the application upload directory.
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $this->render('photos/create', [
                'errors' => ['Could not save the uploaded image.'],
            ]);
            return;
        }

// Create the photo record after the file has been saved.
        (new Photo())->create([
            'user_id' => $_SESSION['user_id'],
            'file_name' => $name,
            'title' => $title,
            'description' => $description,
        ]);

        $this->redirect('/photos');
    }

// Delete a photo owned by the currently logged-in user.
    public function delete(string $id): void
    {
        $this->requireLogin();

        $id = filter_var($id, FILTER_VALIDATE_INT);

        if (!$id) {
            $this->redirect('/photos');
        }

// Remove the database record only when the photo belongs to the current user.
        $file = (new Photo())->deleteOwned(
            $id,
            (int) $_SESSION['user_id']
        );

// Delete the physical image file after removing its database record.
        if ($file) {
            $path = __DIR__ . '/../public/images/uploads/' . basename($file);

            if (is_file($path)) {
                unlink($path);
            }
        }

        $this->redirect('/photos');
    }
}
