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
    <link rel="stylesheet" href="./backend/mvc/user/views/profileSuccStyles.css">
</head>
<body>
    <h1>Profile updated successfully !</h1>
    
    <script>
        setTimeout(function() {
            window.location.href = '/webapp/app.php?service=showLayout#'; // Redirect to a test page -----> CHANGE !!!!
        }, 6000); // Redirect after 3 seconds
    </script>
</body>
</html>
