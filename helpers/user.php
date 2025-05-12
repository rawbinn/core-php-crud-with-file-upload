<?php
require_once __DIR__ . '/../core/db.php';

/**
 * Function to fetch a student by ID.
 */
function getUserById($id) {
    global $connection;

    // Prepare SQL statement to fetch student by ID
    $stmt = $connection->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    return $user;
}

/**
 * Function to fetch all students.
 */
function getUsers() {
    global $connection;

    $query = "SELECT * FROM users";
    $stmt = $connection->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result;
}
