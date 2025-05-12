<?php session_start(); ?>
<h1>Login</h1>

<?php if (!empty($_SESSION['login_error'])): ?>
    <p style="color: red;"><?= $_SESSION['login_error'] ?></p>
    <?php unset($_SESSION['login_error']); ?>
<?php endif; ?>

<form action="/auth/actions/process-login.php" method="POST">
    <label>Email:</label>
    <input type="email" name="email" required><br><br>
    <label>Password:</label>
    <input type="password" name="password" required><br><br>
    <input type="submit" value="Login">
</form>
<a href="/">Back to Home</a>