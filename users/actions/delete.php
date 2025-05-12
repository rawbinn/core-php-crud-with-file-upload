<?php
require_once __DIR__ . '/../../core/db.php'; // Include database connection

// Get the user ID from the query string (URL parameter)
$id = $_GET['id'] ?? null;

if (!$id) {
    // Stop execution if no ID is provided
    die("User ID is missing.");
}

// Get the old profile image
$stmt = $connection->prepare("SELECT profile_image FROM users WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$oldProfileImage = $user['profile_image'] ?? null;

// delete old image
if ($oldProfileImage && file_exists(__DIR__ . '/../../' . $oldProfileImage)) {
    unlink(__DIR__ . '/../../' . $oldProfileImage);
}

// Prepare a SQL DELETE statement using class-style mysqli
$query = "DELETE FROM users WHERE id = ?";
$stmt = $connection->prepare($query); // Create prepared statement

if ($stmt) {
    $stmt->bind_param("i", $id); // Bind the ID (i = integer)
    $stmt->execute(); // Run the query
    $stmt->close();   // Close the statement

    // Redirect to user list after deletion
    header("Location: ../index.php");
    exit;
} else {
    // If something goes wrong, show an error message
    die("Delete failed: " . $connection->error);
}
