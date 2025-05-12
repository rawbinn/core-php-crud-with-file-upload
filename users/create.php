<?php
require_once __DIR__ . '/../core/auth.php';

if (!isLoggedIn()) {
    $_SESSION['error'] = "You must be logged in to access this page";
    redirectToLogin();
}
?>

<h1>Create User</h1>
<form action="actions/store.php" method="POST" enctype="multipart/form-data">
    <label>Name:</label>
    <input type="text" name="name"><br><br>

    <label>Email:</label>
    <input type="text" name="email" value="<?= $_SESSION['old']['email'] ?? '' ?>"><br><br>

    <label>Password:</label>
    <input type="password" name="password"><br><br>

    <label>Profile Image:</label>
    <input type="file" name="profile_image"><br><br>
    <input type="submit" value="Create User">
</form>
<a href="index.php">Back to Users</a>