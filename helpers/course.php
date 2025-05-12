<?php
require_once __DIR__ . '/../core/db.php';

/**
 * Function to fetch a course by ID.
 */
function getCourseById($id) {
    global $connection;

    // Prepare SQL statement to fetch course by ID
    $stmt = mysqli_prepare($connection, "SELECT * FROM courses WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $course = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    return $course;
}

function getCourses() {
    global $connection;

    $query = "SELECT * FROM courses";
    $stmt = $connection->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result;
}