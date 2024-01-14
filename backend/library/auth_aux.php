<?php

function checkUserRole($requiredRole) {
    session_start();
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== $requiredRole) {
        // Redirect to a login page or show an error
        header("Location: loginPage.php");
        exit();
    }
}
