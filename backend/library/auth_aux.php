<?php
function checkUserRole($requiredRole) {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== $requiredRole) {
        // Redirect to a login page or show an error
        echo "Access denied: You do not have permission to view this page.";
        exit();
    }
}

