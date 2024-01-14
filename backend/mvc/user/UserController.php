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
            // Process the registration form submission

            try {
                // Perform validation on the request data
                $username = trim(@$_REQUEST["name"]);
                $password = @$_REQUEST["password"];
                $role = @$_REQUEST["role"];
                $mail = @$_REQUEST["mail"];
                $telephone = @$_REQUEST["telephone"];
                $money = @$_REQUEST["money"];

                if (empty($username) || empty($password) || empty($mail) || empty($telephone) || empty($money)) {
                    throw new Exception("Username, password, email, phone number and money are all required.");
                }

                if ($role !== 'admin' && $role !== 'client') {
                    throw new Exception("Invalid role specified.");
                }

                $userModel = new UserModel();
                $userData = [
                    "name" => $username,
                    "password" => $password, // The UserModel  hashes this password
                    "role" => $role,
                    "mail" => $mail,
                    "telephone" => $telephone,
                    "money" => $money,
                ];

                $result = $userModel->createUser($userData);
                //$result->toJsonEcho();
                header('Location: /webapp/app.php?service=registerSuccess');
                exit();

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
            // Process the login form submission
            $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
    
            if (!$username || !$password) {
                // Handle error - username or password not provided
                echo "Username or Password not provided"; // Display error message
                return;
            }
    
            $userModel = new UserModel();
            $result = $userModel->authenticate($username, $password);
    
            if ($result->result === RequestOperation::SUCCESS) {
                // Authentication successful
                session_start();
                $_SESSION['user'] = $result->data; // Assuming getData returns user data
                $_SESSION['role'] = $result->data['role']; // Storing user role in session
    
                //header("Location: defaultPage.php"); // Redirect to a default page
                exit();
            } else {
                // Authentication failed
                echo "Invalid Username or Password"; // Display error message
            }
        }//$result->toJsonEcho();
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