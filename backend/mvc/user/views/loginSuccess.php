<?php

    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    } else {
        echo "SESSION ALREADY EXISTED !!";
    }
    
    //session_start(); // Start the session
    //var_dump($_SESSION); // Debug: Remove this line after testing
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login successful !</title>
    <!-- Add additional meta tags and CSS links here -->
</head>
<body>
    <h1>Login Successful!</h1>
    <p>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>!</p>
    <p>You will be redirected to your dashboard shortly.</p>
    <script>
        setTimeout(function() {
            window.location.href = '/webapp/app.php?service=showPeopleAsTable'; // Redirect to a test page
        }, 9000); // Redirect after 9 seconds
    </script>
</body>
</html>
