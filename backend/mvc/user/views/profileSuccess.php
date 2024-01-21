<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile updated</title>
    <!-- Add additional meta tags and CSS links here -->
</head>
<body>
    <h1>Profile updated successfully !</h1>
    <p>You will be redirected to your dashboard shortly.</p>
    <script>
        setTimeout(function() {
            window.location.href = '/webapp/app.php?service=showLayout#'; // Redirect to a test page -----> CHANGE !!!!
        }, 3000); // Redirect after 3 seconds
    </script>
</body>
</html>
