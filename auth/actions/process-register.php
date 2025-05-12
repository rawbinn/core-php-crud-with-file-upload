<?php
session_start(); // Start session for storing messages or user login

require_once __DIR__ . '/../../core/db.php'; // Include DB connection

// Get user input and trim whitespace
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

// Validate form fields
if (!$name || !$email || !$password) {
    $_SESSION['register_error'] = "All fields are required.";
    header("Location: ../../auth/register.php");
    exit;
}

// Hash the password for security (never store plain text passwords!)
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// STEP 1: Check if the email is already registered
$checkQuery = "SELECT id FROM users WHERE email = ?";
$checkStmt = $connection->prepare($checkQuery); // Use class-based prepare()

if (!$checkStmt) {
    die("Prepare failed: " . $connection->error); // Useful for debugging
}

$checkStmt->bind_param("s", $email); // Bind the email parameter (s = string)
$checkStmt->execute(); // Execute the SELECT query
$checkStmt->store_result(); // Needed to use num_rows on SELECT

if ($checkStmt->num_rows > 0) {
    $_SESSION['register_error'] = "Email already registered.";
    $checkStmt->close();
    header("Location: ../../auth/register.php");
    exit;
}
$checkStmt->close(); // Always close the statement

// STEP 2: Insert the new user into the database
$insertQuery = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
$insertStmt = $connection->prepare($insertQuery);

if (!$insertStmt) {
    $_SESSION['register_error'] = "Something went wrong. Try again.";
    header("Location: ../../auth/register.php");
    exit;
}

$insertStmt->bind_param("sss", $name, $email, $hashedPassword); // Bind user data
$insertStmt->execute();
$insertStmt->close();

// (Optional) Automatically log in the user after registration
$_SESSION['user'] = [
    'id' => $connection->insert_id,
    'name' => $name,
    'email' => $email
];

// Redirect to homepage
header("Location: ../../index.php");
exit;
