<?php session_start(); ?>
<h1>Register</h1>

<?php if (!empty($_SESSION['register_error'])): ?>
    <p style="color: red;"><?= $_SESSION['register_error'] ?></p>
    <?php unset($_SESSION['register_error']); ?>
<?php endif; ?>

<form action="/auth/actions/process-register.php" method="POST">
    <label>Name:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <input type="submit" value="Register">
</form>

<p>Already have an account? <a href="login.php">Login here</a></p>