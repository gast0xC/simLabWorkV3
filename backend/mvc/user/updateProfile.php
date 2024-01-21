<?php

namespace backend\mvc\user;

use \backend\library\Controller;
use \backend\library\RequestOperation;
use \backend\library\RequestResult;

use \backend\mvc\user\UserModel;
use \Exception;


session_start();
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userModel = new UserModel();

    // Sanitize and validate input
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null; // Only hash if a new password is provided
    $money = filter_input(INPUT_POST, 'money', FILTER_SANITIZE_STRING); // Adjust sanitization according to your needs

    $updateData = [
        'email' => $email,
        'password' => $password, // Make sure to handle the case where password is not changed
        'money' => $money,
        // Add other fields as necessary
    ];

    $result = $userModel->updateUserById($_SESSION['id'], $updateData);

    if ($result->result === RequestOperation::SUCCESS->value) {
        // Redirect to a confirmation page or show a success message
        header('Location: profile_updated_successfully.php');
    } else {
        // Handle errors, e.g., show an error message
        echo "An error occurred: " . $result->msg;
    }
}
