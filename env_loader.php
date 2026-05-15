<?php
/**
 * Minimal .env loader
 * Reads a .env file and loads variables into $_ENV
 */
function loadEnv($path)
{
    if (!file_exists($path)) {
        die('.env file not found at: ' . $path);
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        // Skip comments
        if (strpos(trim($line), '#') === 0) {
            continue;
        }

        // Skip lines without "="
        if (strpos($line, '=') === false) {
            continue;
        }

        list($key, $value) = explode('=', $line, 2);
        $key = trim($key);
        $value = trim($value);

        // Strip surrounding quotes if present
        $value = trim($value, '"\'');

        $_ENV[$key] = $value;
    }
}