<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login successful !</title>
    <!-- Add additional meta tags and CSS links here -->
    <link rel="stylesheet" href="./backend/mvc/user/views/loginSuccStyle.css">
</head>
<body>
    <h1>Login Successful!</h1>
    <p>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>!</p>
    <p>You will be redirected to your dashboard shortly.</p>
    <script>
        setTimeout(function() {
        window.location.href = '/webapp/app.php?service=defaultPage';
    }, 4000);
    </script>
</body>
</html>
