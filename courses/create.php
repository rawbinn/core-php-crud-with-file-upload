<?php
require_once __DIR__ . '/../core/auth.php';

if (!isLoggedIn()) {
    $_SESSION['error'] = "You must be logged in to access this page";
    redirectToLogin();
}
?>
<h1>Create Course</h1>
<form action="actions/store.php" method="POST">
    <label for="name">Course Name:</label>
    <input type="text" name="name" required>
    <br><br>
    <input type="submit" value="Create Course">
</form>
<a href="index.php">Back to Courses</a>