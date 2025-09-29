<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login - Cush's Components</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<?php include __DIR__ . '/../navbar.php'; ?>

<div class="sweep"></div>
<div class="sweep sweep2"></div>

<div class="content">
    <div class="table-container">
        <form method="POST" action="/hello-world/LoginAction.php">
            <h2>Login</h2>
            <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" class="btn">Login</button>
            <p>Don't have an account? <a href="Register.php" class="btn">Register</a></p>
            <!-- <form method="POST">
            <button type="submit" name="register" class="btn">Register</button> -->
        </form>
        </form>
    </div>
</div>

</body>
</html>
