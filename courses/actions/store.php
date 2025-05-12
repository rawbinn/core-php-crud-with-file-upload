<?php
// Check if the form was submitted via POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/../../core/db.php'; // Include database connection

    // Get and sanitize the course name from the POST request
    $name = trim($_POST['name'] ?? ''); // Trim any extra spaces

    // Validate if the course name is provided
    if (empty($name)) {
        die("Course name is required.");
    }

    // Prepare an INSERT SQL statement to add the course to the database
    $query = "INSERT INTO courses (name) VALUES (?)";
    $stmt = $connection->prepare($query); // Prepare the query

    if ($stmt) {
        // Bind the course name as a string (s = string) to the query
        $stmt->bind_param("s", $name);
        $stmt->execute(); // Execute the insert query
        $stmt->close();   // Always close the statement after use

        // Redirect back to the courses index page after the insert
        header("Location: ../index.php");
        exit;
    } else {
        // If there is a query error, show the error message
        die("Query error: " . $connection->error);
    }
} else {
    // If the request method is not POST, show an error
    die("Invalid request.");
}
