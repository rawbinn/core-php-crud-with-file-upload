<?php session_start(); ?>
<h1>Welcome to the Application</h1>

<?php if (isset($_SESSION['user'])): ?>
    <p>Hello, <?= htmlspecialchars($_SESSION['user']['name']) ?> | <a href="/auth/logout.php">Logout</a></p>
<?php else: ?>
    <p><a href="/auth/login.php">Login</a></p>
    <p><a href="/auth/register.php">Register</a></p>
<?php endif; ?>

<ul>
    <li><a href="/courses/index.php">Courses</a></li>
    <li><a href="/users/index.php">Users</a></li>
</ul>