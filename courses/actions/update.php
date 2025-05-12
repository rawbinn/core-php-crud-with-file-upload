<?php
// Check if the form was submitted via POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/../../core/db.php'; // Include database connection

    // Get and sanitize the course ID and name from the POST request
    $id = $_POST['id'] ?? null; // Get course ID
    $name = trim($_POST['name'] ?? ''); // Trim any spaces around the course name

    // Validate that both ID and name are provided
    if (!$id || !$name) {
        die("All fields are required.");
    }

    // Prepare the UPDATE SQL statement to modify the course in the database
    $query = "UPDATE courses SET name = ? WHERE id = ?";
    $stmt = $connection->prepare($query); // Prepare the query

    if ($stmt) {
        // Bind the parameters: s = string (name), i = integer (id)
        $stmt->bind_param("si", $name, $id);
        $stmt->execute(); // Execute the update query
        $stmt->close();   // Always close the statement after use

        // Redirect to the courses index page after updating the course
        header("Location: ../index.php");
        exit;
    } else {
        // If there is a query error, show the error message
        die("Update failed: " . $connection->error);
    }
} else {
    // If the request method is not POST, show an error
    die("Invalid request.");
}
