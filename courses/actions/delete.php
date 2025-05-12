<?php
require_once __DIR__ . '/../../core/db.php'; // Include DB connection

// Get the course ID from the URL query parameter
$id = $_GET['id'] ?? null;

if (!$id) {
    // If no course ID is provided, display an error message
    die("Course ID is missing.");
}

// Prepare the DELETE SQL statement using class-style mysqli
$query = "DELETE FROM courses WHERE id = ?";
$stmt = $connection->prepare($query); // Create prepared statement

if ($stmt) {
    // Bind the ID to the prepared statement (i = integer)
    $stmt->bind_param("i", $id);
    $stmt->execute(); // Execute the delete query
    $stmt->close();   // Close the statement

    // Redirect to the courses index page
    header("Location: ../index.php");
    exit;
} else {
    // If the query fails, display an error message
    die("Delete failed: " . $connection->error);
}
