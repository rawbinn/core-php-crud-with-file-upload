<?php
require_once __DIR__ . '/../helpers/course.php';
require_once __DIR__ . '/../core/auth.php';

if (!isLoggedIn()) {
    $_SESSION['error'] = "You must be logged in to access this page";
    redirectToLogin();
}

$id = $_GET['id'] ?? null;

if (!$id) {
    die("Course ID is missing.");
}

$course = getCourseById($id);

if (!$course) {
    die("Course not found.");
}
?>

<h1>Edit Course</h1>
<form action="actions/update.php" method="POST">
    <input type="hidden" name="id" value="<?= $course['id'] ?>">
    <label for="name">Course Name:</label>
    <input type="text" name="name" value="<?= htmlspecialchars($course['name']) ?>" required>
    <br><br>
    <input type="submit" value="Update Course">
</form>
<a href="index.php">Back to Courses</a>