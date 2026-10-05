<?php

// Start the session before controllers and views need access to user data.
session_start();

// Load application configuration and database setup.
require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/database.php';

// Load the MVC core classes.
require_once __DIR__ . '/../core/Model.php';
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/Router.php';

// Load the application models.
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Photo.php';
require_once __DIR__ . '/../models/Comment.php';

// Load the application controllers.
require_once __DIR__ . '/../controllers/AuthController.php';
require_once __DIR__ . '/../controllers/PhotoController.php';
require_once __DIR__ . '/../controllers/CommentController.php';
require_once __DIR__ . '/../controllers/HomeController.php';

// Create the central router used to handle incoming requests.
$router = new Router();

// Register public page routes.
$router->add('GET', '/', ['HomeController', 'index']);
$router->add('GET', '/about', ['HomeController', 'about']);
$router->add('GET', '/register-success', ['HomeController', 'registered']);

// Register authentication routes for login, registration, and logout.
$router->add('GET', '/login', ['AuthController', 'showLogin']);
$router->add('POST', '/login', ['AuthController', 'login']);
$router->add('GET', '/register', ['AuthController', 'showRegister']);
$router->add('POST', '/register', ['AuthController', 'register']);
$router->add('GET', '/logout', ['AuthController', 'logout']);

// Register routes for viewing and managing photos.
$router->add('GET', '/photos', ['PhotoController', 'index']);
$router->add('GET', '/photo/create', ['PhotoController', 'create']);
$router->add('POST', '/photo/store', ['PhotoController', 'store']);
$router->add('GET', '/photo/{id}', ['PhotoController', 'show']);
$router->add('GET', '/photo/{id}/delete', ['PhotoController', 'delete']);

// Register the route used to create photo comments.
$router->add('POST', '/comment/store', ['CommentController', 'store']);

// Send the request to the correct controller action.
$router->dispatch(
    $_SERVER['REQUEST_METHOD'],
    $_SERVER['REQUEST_URI']
);
