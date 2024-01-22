<?php

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Check for the refresh parameter and refresh the page once
    if (isset($_GET['refresh']) && $_GET['refresh'] == '1') {
        // Use JavaScript to refresh the page without the query parameter
        echo '<script>window.location.href = "/webapp/app.php?service=showLayout";</script>';
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adrenaline Adventures</title>
    <link rel="stylesheet" href="./backend/mvc/layouts/views/defaultStyles.css"> <!-- Substitua com o caminho do seu arquivo CSS, se aplicável -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

</head>
<body class="error-page">
    <div class="error-container">
        <h1>Adrenaline Adventures</h1>
        <p>"Thrills Beyond Limits: Explore the Extreme with Adrenaline Adventures</p>
    </div>

    <script>
        
    </script>
</body>
</html>
