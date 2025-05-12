<?php
// Check if the request is a POST request (form submission)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/../../core/db.php'; // Include DB connection

    // Get and sanitize input values
    $id = $_POST['id'] ?? null; // User ID
    $name = trim($_POST['name'] ?? ''); // Name (trim spaces)
    $email = trim($_POST['email'] ?? ''); // Email (trim spaces)
    $password = trim($_POST['password'] ?? ''); // Password (trim spaces)

    if ($password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    }

    // Validate form data
    if (!$id || !$name || !$email) {
        die("All fields are required.");
    }

    // Get the old profile image
    $stmt = $connection->prepare("SELECT profile_image FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $oldProfileImage = $user['profile_image'] ?? null;

    if(!empty($_FILES['profile_image']['name'])) {
        $imageName = time() . '_' . basename($_FILES['profile_image']['name']);
        $targetDir = __DIR__ . '/../../uploads/users/';
        $targetPath = $targetDir . $imageName;

        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $targetPath)) {
            $imagePath = 'uploads/users/' . $imageName;

            // Optionally delete old image
            if ($oldProfileImage && file_exists(__DIR__ . '/../../' . $oldProfileImage)) {
                unlink(__DIR__ . '/../../' . $oldProfileImage);
            }
        }
    } else {
        $imagePath = $oldProfileImage;
    }
    

    // Prepare the SQL UPDATE statement using class-style mysqli
    if ($password) {
        $query = "UPDATE users SET name = ?, email = ?, password = ?, profile_image = ? WHERE id = ?";
    } else {
        $query = "UPDATE users SET name = ?, email = ?, profile_image = ? WHERE id = ?";
    }
    $stmt = $connection->prepare($query); // Create prepared statement

    if ($stmt) {
        // Bind the parameters to the prepared statement (i = integer, s = string)
        if ($password) {
            $stmt->bind_param("ssssi", $name, $email, $hashedPassword, $imagePath, $id);
        } else {
            $stmt->bind_param("sssi", $name, $email, $imagePath, $id);
        }
        $stmt->execute(); // Execute the update query
        $stmt->close();   // Close the statement after use

        // Redirect back to the users index page
        header("Location: ../index.php");
        exit;
    } else {
        // If the query fails, display the error
        die("Update failed: " . $connection->error);
    }
} else {
    // If it's not a POST request, display an error
    die("Invalid request.");
}
