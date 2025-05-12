<?php
session_start();
/**
 * Check if the user is logged in
 */
function isLoggedIn() {
    return isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true;
}

/**
 * Redirect to the login page if the user is not logged in
 */
function redirectToLogin() {
    header("Location: ../auth/login.php");
    exit;
}

/**
 * Get the current user
 */
function getCurrentUser() {
    return $_SESSION['user'] ?? null;
}

/**
 * Logout the user
 */
function logout() {
    // unset the session
    session_destroy();
}

