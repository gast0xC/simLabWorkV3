<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register successful !</title>
    <!-- Add additional meta tags and CSS links here -->
    <link rel="stylesheet" href="./backend/mvc/user/views/registerSuccStyles.css">
</head>
<body>
    <h1>Register Successful!</h1>
    <p>Please login afterwards.</p>
    <script>
        setTimeout(function() {
            window.location.href = '/webapp/app.php?service=defaultPage'; // Redirect to a test page -----> CHANGE !!!!
        }, 7000); // Redirect after 3 seconds
    </script>
</body>
</html>