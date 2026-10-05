<?php

/**
 * Application URL helper for XAMPP subdirectory installations.
 */
// Build the application base URL for installations inside a server subdirectory.
if (!defined('APP_BASE_URL')) {
    $scriptDirectory = rtrim(
        str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/')),
        '/'
    );

    define(
        'APP_BASE_URL',
        $scriptDirectory === '' ? '' : $scriptDirectory
    );
}

// Create application URLs while respecting the configured base directory.
function url(string $path = '/'): string
{
    return APP_BASE_URL . '/' . ltrim($path, '/');
}
