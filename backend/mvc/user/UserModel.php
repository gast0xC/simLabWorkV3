<?php

namespace backend\mvc\user;

use backend\library\Model;
use backend\library\RequestOperation;
use backend\library\RequestResult;
use PDO;
use Exception;

class UserModel extends Model
{
    function createUser(array $userData): RequestResult
    {
        try {
            $pdo = $this->getPdoConnection();
            $query_string = "INSERT INTO user (name, password, role, email, telephone, money) VALUES (:name, :password, :role, :email, :telephone, :money)";
            $statement = $pdo->prepare($query_string);

            // Hash the password before saving
            $userData['password'] = password_hash($userData['password'], PASSWORD_DEFAULT);

            $statement->execute($userData);

            return RequestResult::requestSUCCESS(RequestOperation::INSERT, $pdo, $statement, $query_string);
        } catch (Exception $e) {
            return RequestResult::requestERROR(RequestOperation::INSERT, "error creating user: " . $e->getMessage());
        }
    }

    function selectUserByName ($name): RequestResult {
        try {
            $pdo = $this->getPdoConnection();
            $query_string = "SELECT id, name, role FROM user WHERE name = :name";
            $statement = $pdo->prepare($query_string);
    
            $statement->execute(['name' => $name]);
            $user = $statement->fetch(PDO::FETCH_ASSOC);
    
            if ($user) {

                $statement = $pdo->prepare($query_string);
                $statement->execute(['name' => $name]);

                $result = RequestResult::requestSUCCESS(RequestOperation::SELECT, $pdo, $statement, 'User selected successfully.');
                $result->data = $user;
    
                return $result;
            } else {
                return RequestResult::requestERROR(RequestOperation::SELECT, "No user found with that name.");
            }
        } catch (Exception $e) {
            return RequestResult::requestERROR(RequestOperation::SELECT, "error: " . $e->getMessage());
        }
    }

    
    function selectUserById($id): RequestResult {
        try {
            $pdo = $this->getPdoConnection();
            $query_string = "SELECT * FROM user WHERE id = :id";
            $statement = $pdo->prepare($query_string);
            $statement->execute(['id' => $id]);
            $user = $statement->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                return RequestResult::requestSUCCESS(RequestOperation::SELECT, $pdo, $statement, 'User selected successfully.');
            } else {
                return RequestResult::requestERROR(RequestOperation::SELECT, "No user found with that ID.");
            }
        } catch (Exception $e) {
            return RequestResult::requestERROR(RequestOperation::SELECT, "error: " . $e->getMessage());
        }
    }


    function updateUserById($userId, $updateData): RequestResult {
        try {
            $pdo = $this->getPdoConnection();
            
            $query = "UPDATE user SET email = :email, money = :money";
            $params = ['email' => $updateData['email'], 'money' => $updateData['money']];

            if (!empty($updateData['password'])) {
                $query .= ", password = :password";
                $params['password'] = $updateData['password'];
            }

            $query .= " WHERE id = :id";
            $params['id'] = $userId;

            $statement = $pdo->prepare($query);
            $statement->execute($params);

            return RequestResult::requestSUCCESS(RequestOperation::UPDATE, $pdo, $statement, 'User updated successfully.');
        } catch (Exception $e) {
            return RequestResult::requestERROR(RequestOperation::UPDATE, "error: " . $e->getMessage());
        }
    }

    
    function updateUserRole($id, $newRole): RequestResult
    {
        try {
            $pdo = $this->getPdoConnection();
            $query_string = "UPDATE user SET role = :role WHERE id = :id";
            $statement = $pdo->prepare($query_string);

            $statement->execute([
                'id' => $id,
                'role' => $newRole
            ]);

            return RequestResult::requestSUCCESS(RequestOperation::UPDATE, $pdo, $statement, $query_string);
        } catch (Exception $e) {
            return RequestResult::requestERROR(RequestOperation::UPDATE, "error updating user role: " . $e->getMessage());
        }
    }

    function deleteUser($id): RequestResult
    {
        try {
            $pdo = $this->getPdoConnection();
            $query_string = "DELETE FROM user WHERE id = :id";
            $statement = $pdo->prepare($query_string);

            $statement->execute(['id' => $id]);

            return RequestResult::requestSUCCESS(RequestOperation::DELETE, $pdo, $statement, $query_string);
        } catch (Exception $e) {
            return RequestResult::requestERROR(RequestOperation::DELETE, "error deleting user: " . $e->getMessage());
        }
    }

    function authenticate($name, $password): RequestResult
{
    try {
        $pdo = $this->getPdoConnection();
        $query_string = "SELECT id, name, password, role, email, telephone, money FROM user WHERE name = :name";
        $statement = $pdo->prepare($query_string);

        $statement->execute(['name' => $name]);
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Unset the password from the array before returning to ensure security
            unset($user['password']);
            return RequestResult::requestSUCCESS(RequestOperation::AUTHENTICATE, $pdo, $statement, 'Authentication successful.');
        } else {
            throw new Exception("Authentication failed: Invalid username or password.");
        }
    } catch (Exception $e) {
        return RequestResult::requestERROR(RequestOperation::AUTHENTICATE, "error: " . $e->getMessage());
    }
}


}