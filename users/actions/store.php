<?php
session_start();

// Check if the request is a POST request (form submission)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/../../core/db.php'; // Include DB connection

    $_SESSION['old'] = $_POST;

    // Trim input to remove extra whitespace
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
   
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Validate form data
    if (!$name || !$email || !$password) {
        die("Name, Email and Password are required.");
    }
    if (!empty($_FILES['profile_image']['name'])) {
        $imageName = time() . '_' . basename($_FILES['profile_image']['name']);
        $targetDir = __DIR__ . '/../../uploads/users';
        $targetPath = $targetDir . '/' . $imageName;

        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $targetPath)) {
            $imagePath = 'uploads/users/' . $imageName;
        }
    }

    // Prepare an INSERT statement using class-based mysqli
    $query = "INSERT INTO users (name, email, password, profile_image) VALUES (?, ?, ?, ?)";
    $stmt = $connection->prepare($query);

    if ($stmt) {
        $stmt->bind_param("ssss", $name, $email, $hashedPassword, $imagePath); // Bind name, email, password and profile_image as strings (s = string)
        $stmt->execute(); // Execute the insert query
        $stmt->close();   // Always close the statement

        // Redirect to the user index page
        header("Location: ../index.php");
        exit;
    } else {
        // If prepare fails, show error
        die("Insert failed: " . $connection->error);
    }
} else {
    // If the request is not POST, show an error
    die("Invalid request.");
}
