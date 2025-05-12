<?php

/**
 * Redirect to the given path
 * 
 * @param string $path The path to redirect to
 * @throws RuntimeException If headers have already been sent
 */
function redirectTo($path)
{
    if (empty($path)) {
        throw new InvalidArgumentException('Redirect path cannot be empty');
    }

    if (headers_sent()) {
        throw new RuntimeException('Headers have already been sent');
    }

    header("Location: " . urlencode($path));
    exit;
}

/**
 * Get the base URL
 * 
 * @param string $path The path to append to the base URL
 * @return string The complete URL
 * @throws RuntimeException If config file is not found
 */
function url($path)
{
    $configFile = __DIR__ . '/../config/app.php';
    
    if (!file_exists($configFile)) {
        throw new RuntimeException('Configuration file not found');
    }

    $config = require $configFile;
    
    if (empty($config['base_url'])) {
        throw new RuntimeException('Base URL not configured');
    }

    $baseUrl = rtrim($config['base_url'], '/');
    $path = ltrim($path, '/');
    return $baseUrl . '/' . $path;
}
