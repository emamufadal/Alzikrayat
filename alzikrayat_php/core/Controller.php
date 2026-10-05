<?php

// Provides shared rendering and redirect helpers for controllers.
abstract class Controller
{
// Load a view and make the supplied data available to it.
    protected function render(string $view, array $data = []): void
    {
// Convert the view data array into variables used by the template.
        extract($data, EXTR_SKIP);

        require __DIR__ . '/../views/' . $view . '.php';
    }

// Redirect the browser to another application route.
    protected function redirect(string $path): void
    {
        header('Location: ' . url($path));
        exit;
    }
}
