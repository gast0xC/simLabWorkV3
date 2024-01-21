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
                $name = trim(@$_REQUEST["name"]);
                $password = @$_REQUEST["password"];
                $role = @$_REQUEST["role"];
                $email = @$_REQUEST["email"];
                $telephone = @$_REQUEST["telephone"];
                $money = @$_REQUEST["money"];

                if (empty($name) || empty($password) || empty($email) || empty($telephone) || empty($money)) {
                    throw new Exception("Username, password, email, phone number and money are all required.");
                }

                if ($role !== 'admin' && $role !== 'client') {
                    throw new Exception("Invalid role specified.");
                }

                $userModel = new UserModel();
                $userData = [
                    "name" => $name,
                    "password" => $password, // The UserModel  hashes this password
                    "role" => $role,
                    "email" => $email,
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
        include(__DIR__ . '/views/registerSuccess.php');
    }

    function loginSuccess()
    {
        include(__DIR__ . '/views/loginSuccess.php');
    }

    function logout() {
        // Start the session
        session_start();

        // Unset all session variables
        session_unset();
    
        // Destroy the session
        session_destroy();
    
        // To kill the session cookie as well
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        
        // Redirect to the home page
        sleep(1);
        header("Location: /webapp/app.php?service=showLayout");
        exit();
    }
    

    function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            // Display the login form
            include(__DIR__ . '/views/login.php');
    
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Process the login form submission
            $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
    
            if (!$name || !$password) {
                echo "Username or Password not provided";
                return;
            }
    
            $userModel = new UserModel();
            $result = $userModel->authenticate($name, $password);
    
            if ($result->result === RequestOperation::SUCCESS->value) {
                session_start();
                session_regenerate_id(true);
    
                // Retrieve user data from the UserModel
                $userData = $userModel->selectUserByName($name);
    
                if ($userData->result === RequestOperation::SUCCESS->value && $userData->data) {
                    // Assign the user data to session variables
                    $_SESSION['id'] =   $userData->data['id'];
                    $_SESSION['name'] = $userData->data['name'];
                    $_SESSION['role'] = $userData->data['role'];
                } else {
                    var_dump($userData);
                    echo "Failed to retrieve user data";
                    return;
                }
    
                // Redirect to the successful login page
                header("Location: /webapp/app.php?service=loginSuccess");
                exit();
            } else {
                echo "Invalid Username or Password"; // Display error message
            }
        }
    }

    function accessProfile () {
        
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['id'])) {
            include(__DIR__ . '/views/login.php');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            include(__DIR__ . '/views/profile.php');

        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
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


}