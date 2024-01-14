<?php

namespace backend\mvc\user;

use \backend\library\Controller;
use \backend\library\RequestOperation;
use \backend\library\RequestResult;

use \backend\mvc\user\UserModel;
use \Exception;

class UserController extends Controller
{
    function __construct()
    {
        
    }

    function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            // Display the registration form
            include(__DIR__ . '/views/register.php');
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // Perform validation on the request data
                $username = trim(@$_REQUEST["name"]);
                $password = @$_REQUEST["password"];
                $role = @$_REQUEST["role"];
                $email = @$_REQUEST["email"];
                $telephone = @$_REQUEST["telephone"];
                $money = @$_REQUEST["money"];

                if (empty($username) || empty($password) || empty($email) || empty($telephone) || empty($money)) {
                    throw new Exception("Username, password, email, phone number and money are all required.");
                }

                if ($role !== 'admin' && $role !== 'client') {
                    throw new Exception("Invalid role specified.");
                }

                $userModel = new UserModel();
                $userData = [
                    "name" => $username,
                    "password" => $password, // The UserModel will hash this password
                    "role" => $role,
                    "email" => $email,
                    "telephone" => $telephone,
                    "money" => $money,
                ];

                $result = $userModel->createUser($userData);

                if (!headers_sent()) {
                    header('Location: /webapp/app.php?service=registerSuccess');
                    exit();
                } else {
                    echo "Redirect failed. Headers already sent.";
                }
            } catch (Exception $e) {
                RequestResult::requestERROR(RequestOperation::INSERT, $e->getMessage())->toJsonEcho();
            }
        }
    }

    function registerSuccess()
    {
        echo "Registration successful!";
    }


    function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            // Display the login form
            include(__DIR__ . '/views/login.php');
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);

            if (!$username || !$password) {
                echo "Username or Password not provided"; // Display error message
                return;
            }

            $userModel = new UserModel(); 
            $result = $userModel->authenticate($username, $password);

            if ($result->result === RequestOperation::SUCCESS) {
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }

                // Regenerate session ID upon successful login
                session_regenerate_id(true);

                $_SESSION['user'] = $result->data['name']; // Store username in session
                $_SESSION['role'] = $result->data['role']; // Store user role in session

                if (!headers_sent()) {
                    header("Location: /webapp/app.php?service=showAbout"); // Redirect to a default page
                    exit();
                } else {
                    echo "Redirect failed. Headers already sent.";
                }
            } else {
                echo "Invalid Username or Password"; // Display error message
            }
        }
    }

    function deleteUser($id)
    {
        $userModel = new UserModel();
        $result = $userModel->deleteUser($id);
        $result->toJsonEcho();
    }

    function updateUserRole()
    {
        $id = @$_REQUEST["id"];
        $newRole = @$_REQUEST["role"];
        $userModel = new UserModel();

        if ($newRole !== 'admin' && $newRole !== 'client') {
            RequestResult::requestERROR(RequestOperation::UPDATE, "Invalid role specified.")->toJsonEcho();
            return;
        }

        $result = $userModel->updateUserRole($id, $newRole);
        $result->toJsonEcho();
    }

    // Other methods to be add later, like views and stuff
}