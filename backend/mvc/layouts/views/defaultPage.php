<?php

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Check if we've just logged in and need to refresh the page once
    if (isset($_GET['loginSuccess']) && $_GET['loginSuccess'] && !isset($_SESSION['has_refreshed'])) {
        $_SESSION['has_refreshed'] = true;
        // Output a JavaScript command to refresh the page without the query parameter
        echo '<script>window.location.href = window.location.pathname + window.location.search.replace(/(\?|&)loginSuccess=true/, "");</script>';
        exit;
    }

    // Check if the page has been refreshed, then unset the flag to prevent further refreshes
    if (isset($_SESSION['has_refreshed'])) {
        unset($_SESSION['has_refreshed']);
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
