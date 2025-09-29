<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Register - Cush's Components</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<?php include __DIR__ . '/../navbar.php'; ?>

<div class="sweep"></div>
<div class="sweep sweep2"></div>

<div class="content">
    <div class="table-container">
        <form method="POST" action="../RegisterAction.php">
            <h2>Create Account</h2>
            <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" class="btn">Create Account</button>
            
        </form>
        <p>Already have an account? <a href="Login.php">Login</a></p>
    </div>
</div>

</body>
</html>
