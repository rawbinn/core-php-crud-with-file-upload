<?php
session_start(); // Start the session to store user data and messages

require_once __DIR__ . '/../../core/db.php'; // Include DB connection

// Get email and password from POST request
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

// Validate required fields
if (!$email || !$password) {
    $_SESSION['login_error'] = "Email and password are required.";
    header("Location: ../../auth/login.php");
    exit;
}

// Prepare a SQL statement to select user by email
$query = "SELECT * FROM users WHERE email = ?";
$stmt = $connection->prepare($query); // Create prepared statement using class-style mysqli

if (!$stmt) {
    // If prepare fails, show error and stop
    die("Prepare failed: " . $connection->error);
}

$stmt->bind_param("s", $email); // Bind the email to the placeholder (s = string)
$stmt->execute(); // Execute the SQL statement

$result = $stmt->get_result(); // Get the result set
$user = $result->fetch_assoc(); // Fetch the user as an associative array

// Verify password using password_verify (compares hash with plain password)
if ($user && password_verify($password, $user['password'])) {
    // If login is successful, store user data in session
    $_SESSION['user'] = [
        'id' => $user['id'],
        'name' => $user['name'],
        'email' => $user['email']
    ];

    $_SESSION['is_logged_in'] = true;

    // Redirect to home page
    header("Location: ../../index.php");
    exit;
} else {
    // If login fails, set an error message and redirect back
    $_SESSION['login_error'] = "Invalid credentials.";
    header("Location: ../../auth/login.php");
    exit;
}
