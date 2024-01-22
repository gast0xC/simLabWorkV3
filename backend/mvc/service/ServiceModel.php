<?php

namespace backend\mvc\service;

use backend\library\Model;
use backend\library\RequestOperation;
use backend\library\RequestResult;
use PDO;
use Exception;

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
