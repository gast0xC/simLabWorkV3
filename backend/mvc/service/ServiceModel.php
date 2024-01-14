<?php

namespace backend\mvc\service;

use backend\library\Model;
use backend\library\RequestOperation;
use backend\library\RequestResult;
use PDO;
use Exception;

class ServiceModel extends Model
{
    public function createService($serviceData)
    {
        try {
            $sql = "INSERT INTO services (name, description, local, price, activity) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                $serviceData['name'],
                $serviceData['description'],
                $serviceData['local'],
                $serviceData['price'],
                $serviceData['activity']
            ]);
            return true;
        } catch (PDOException $e) {
            // Handle exception
            return false;
        }
    }

    public function getServiceById($id)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM services WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            // Handle exception
            return null;
        }
    }
    public function updateService($id, $serviceData)
    {
        try {
            $sql = "UPDATE services SET name = ?, description = ?, local = ?, price = ?, activity = ? WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                $serviceData['name'],
                $serviceData['description'],
                $serviceData['local'],
                $serviceData['price'],
                $serviceData['activity'],
                $id
            ]);
            return true;
        } catch (PDOException $e) {
            // Handle exception
            return false;
        }
    }
    
    public function deleteService($id)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM services WHERE id = ?");
            $stmt->execute([$id]);
            return true;
        } catch (PDOException $e) {
            // Handle exception
            return false;
        }
    }
    
    // Additional methods can be added as needed
    }
    ?>
    