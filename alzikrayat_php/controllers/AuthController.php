<?php

// Handles registration, login, and logout operations.
class AuthController extends Controller
{
// Displays the login page and passes the previous login time to the view.
    public function showLogin(): void
    {
        $this->render('auth/login', [
            'lastLogin' => $_COOKIE['last_login'] ?? null,
        ]);
    }

// Displays the registration form.
    public function showRegister(): void
    {
        $this->render('auth/register');
    }

// Validates submitted registration data and creates a new user account.
    public function register(): void
    {
        $first = trim($_POST['first_name'] ?? '');
        $last = trim($_POST['last_name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $pass = $_POST['password'] ?? '';
        $errors = [];

// Validate the first and last names before creating the account.
        if (!preg_match('/^[A-Za-z]{1,50}$/', $first)) {
            $errors[] = 'First name must contain letters only.';
        }

        if (!preg_match('/^[A-Za-z]{1,50}$/', $last)) {
            $errors[] = 'Last name must contain letters only.';
        }

// Validate that the submitted email has a valid format.
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Please enter a valid email.';
        }

// Require a minimum password length of eight characters.
        if (strlen($pass) < 8) {
            $errors[] = 'Password must contain at least 8 characters.';
        }

        $users = new User();

// Prevent registration when the email is already in use.
        if (!$errors && $users->findByEmail($email)) {
            $errors[] = 'Email is already registered.';
        }

// Return the validation errors to the registration form.
        if ($errors) {
            $this->render('auth/register', [
                'errors' => $errors,
            ]);
            return;
        }

// Store the new user with a securely hashed password.
        $users->create([
            'first_name' => $first,
            'last_name' => $last,
            'email' => $email,
            'password' => password_hash($pass, PASSWORD_DEFAULT),
            'location' => trim($_POST['location'] ?? ''),
            'description' => trim($_POST['description'] ?? ''),
            'occupation' => trim($_POST['occupation'] ?? ''),
        ]);

        $this->redirect('/register-success');
    }

// Authenticates an existing user with the submitted credentials.
    public function login(): void
    {
        $email = trim($_POST['email'] ?? '');
        $pass = $_POST['password'] ?? '';
        $user = (new User())->findByEmail($email);

// Reject invalid login credentials and show an error message.
        if (!$user || !password_verify($pass, $user['password'])) {
            $this->render('auth/login', [
                'errors' => ['Invalid email or password.'],
                'lastLogin' => $_COOKIE['last_login'] ?? null,
            ]);
            return;
        }

// Regenerate the session ID after successful authentication.
        session_regenerate_id(true);
        $_SESSION['user_id'] = (int) $user['id'];
        $_SESSION['first_name'] = $user['first_name'];

// Remember the latest login time for this browser for seven days.
        setcookie('last_login', date('Y-m-d H:i:s'), [
            'expires' => time() + 604800,
            'path' => '/',
            'httponly' => true,
            'samesite' => 'Lax',
        ]);

        $this->redirect('/photos');
    }

// Clears the current session and redirects the user to the home page.
    public function logout(): void
    {
        $_SESSION = [];
        session_destroy();

        $this->redirect('/');
    }
}
