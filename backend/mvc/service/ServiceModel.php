<?php

namespace backend\mvc\service;


use backend\mvc\service\ServiceModel;
use backend\library\Model;
use backend\library\RequestOperation;
use backend\library\RequestResult;
use PDO;
use Exception;
use backend\mvc\user\UserModel;
class ServiceModel extends Model
{
    function selectAll($id = null, $name = null): RequestResult {
        try {
            $pdo = $this->getPdoConnection();
            $query_string = "SELECT id, name, description, local, price, activity FROM service WHERE (1=1) ";  // space is necessary 

            if (isset($id)) {
                $query_string .= " AND (id = {$id}) ";
            }

            if (isset($name)) {
                $query_string .= " AND (name LIKE '{$name}') ";
            }

            $statement = $pdo->query($query_string, PDO::FETCH_ASSOC);

            return RequestResult::requestSUCCESS(RequestOperation::SELECT, $pdo, $statement, $query_string);
        } catch (Exception $e) {
            return RequestResult::requestERROR(RequestOperation::SELECT, "error: " . $e->getMessage());
        }
    }
    function selectBestDeals(): RequestResult {
        try {
            $pdo = $this->getPdoConnection();
            $query_string = "SELECT id, name, description, local, price, activity FROM service ORDER BY price ASC LIMIT 3";
            $statement = $pdo->query($query_string, PDO::FETCH_ASSOC);
            return RequestResult::requestSUCCESS(RequestOperation::SELECT, $pdo, $statement, $query_string);
        } catch (Exception $e) {
            return RequestResult::requestERROR(RequestOperation::SELECT, "error: " . $e->getMessage());
        }
    }
    function searchByActivity($activity = null): RequestResult {
        try {
            $pdo = $this->getPdoConnection();
            $query_string = "SELECT id, name, description, local, price, activity FROM service";
            if (!empty($activity)) {
                $query_string .= " WHERE LOWER(activity) LIKE LOWER(:activity)";
                $statement = $pdo->prepare($query_string);
                $statement->bindValue(':activity', '%' . trim($activity) . '%', PDO::PARAM_STR);
            } else {
                $query_string = "SELECT id, name, description, local, price, activity FROM service WHERE 1=0";
                $statement = $pdo->prepare($query_string);
            }
    
            $statement->execute();
            return RequestResult::requestSUCCESS(RequestOperation::SELECT, $pdo, $statement, $query_string);
        } catch (Exception $e) {
            return RequestResult::requestERROR(RequestOperation::SELECT, "error: " . $e->getMessage());
        }
    }
    
    function buyService($id = null): RequestResult {
        try {
            // Establish database connection
            $pdo = $this->getPdoConnection();
    
            // Fetch the service price
            $query_string = "SELECT price FROM service WHERE id = :id";
            $statement = $pdo->prepare($query_string);
            $statement->execute(['id' => $id]);
            $service = $statement->fetch(PDO::FETCH_ASSOC);
        
            if (!$service) {
                error_log("Service with ID $id not found."); // Log for debugging
                return RequestResult::requestERROR(RequestOperation::SELECT, "Service not found");
            }
    
            $servicePrice = $service['price'];
    
            // Fetch user's current balance
            $userModel = new UserModel();
            $userData = $userModel->selectUserByName($_SESSION['name']);
            if ($userData->result !== RequestOperation::SUCCESS->value) {
                return RequestResult::requestERROR(RequestOperation::SELECT, "User not found");
            }
    
            $userMoney = $userData->data['money'];
    
            // Check if the user has enough money
            if ($userMoney >= $servicePrice) {
                $newBalance = $userMoney - $servicePrice;
    
                // Update the user's balance
                $updateQueryString = "UPDATE user SET money = :money WHERE name = :name";
                $updateStatement = $pdo->prepare($updateQueryString);
                $updateStatement->execute(['money' => $newBalance, 'name' => $_SESSION['name']]);
    
                // Pass the PDOStatement object as the third argument
                return RequestResult::requestSUCCESS(RequestOperation::UPDATE, $pdo, $updateStatement, "Service purchased successfully");
            } else {
                return RequestResult::requestERROR(RequestOperation::UPDATE, "Insufficient funds");
            }
    
        } catch (Exception $e) {
            return RequestResult::requestERROR(RequestOperation::SELECT, "Error: " . $e->getMessage());
        }
    }
    
    
    
    

    // Method to insert a new service
    function insert(array $serviceData): RequestResult
    {
        try {
            $pdo = $this->getPdoConnection();
            $query_string = "INSERT INTO service (name, description, local, price, activity) VALUES (:name, :description, :local, :price, :activity)";
            $statement = $pdo->prepare($query_string);
            $statement->execute($serviceData);
            return RequestResult::requestSUCCESS(RequestOperation::INSERT, $pdo, $statement, $query_string);
        } catch (Exception $e) {
            return RequestResult::requestERROR(RequestOperation::INSERT, "error inserting a service: " . $e->getMessage());
        }
    }

    // Method to select a service by ID
    function select($id): RequestResult
    {
        try {
            $pdo = $this->getPdoConnection();
            $query_string = "SELECT id, name, description, local, price, activity FROM service WHERE id=:id";
            $statement = $pdo->prepare($query_string);
            $statement->execute(['id' => $id]);
            return RequestResult::requestSUCCESS(RequestOperation::SELECT, $pdo, $statement, $query_string);
        } catch (Exception $e) {
            return RequestResult::requestERROR(RequestOperation::SELECT, "error: " . $e->getMessage());
        }
    }

    // Method to update a service
    function update(array $serviceData): RequestResult
    {
        try {
            $pdo = $this->getPdoConnection();
            $query_string = "UPDATE service SET name=:name, description=:description, local=:local, price=:price, activity=:activity WHERE id=:id";
            $statement = $pdo->prepare($query_string);
            $statement->execute($serviceData);
            return RequestResult::requestSUCCESS(RequestOperation::UPDATE, $pdo, $statement, $query_string);
        } catch (Exception $e) {
            return RequestResult::requestERROR(RequestOperation::UPDATE, "error updating a service: " . $e->getMessage());
        }
    }

    // Method to delete a service
    function delete($id): RequestResult
    {
        try {
            $pdo = $this->getPdoConnection();
            $query_string = "DELETE FROM service WHERE id=:id";
            $statement = $pdo->prepare($query_string);
            $statement->execute(['id' => $id]);
            return RequestResult::requestSUCCESS(RequestOperation::DELETE, $pdo, $statement, $query_string);
        } catch (Exception $e) {
            return RequestResult::requestERROR(RequestOperation::DELETE, "error deleting a service: " . $e->getMessage());
        }
    }

    // Additional methods can be added as needed
}
