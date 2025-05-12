<?php
require_once __DIR__ . '/../helpers/course.php';
require_once __DIR__ . '/../core/auth.php';

if (!isLoggedIn()) {
    $_SESSION['error'] = "You must be logged in to access this page";
    redirectToLogin();
}

$courses = getCourses();
?>
<h1>Courses</h1>
<a href="create.php">Create New Course</a>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($courses as $course): ?>
        <tr>
            <td><?= $course['id'] ?></td>
            <td><?= $course['name'] ?></td>
            <td>
                <a href="edit.php?id=<?= $course['id'] ?>">Edit</a> |
                <a href="actions/delete.php?id=<?= $course['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>