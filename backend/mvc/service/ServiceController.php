<?php

namespace backend\mvc\service;

use \backend\library\Controller;
use \backend\library\RequestOperation;
use \backend\library\RequestResult;

use \backend\mvc\person\PersonModel;
use \Exception;


class ServiceController extends Controller
{
    function __construct()
    {
        // Constructor code here
    }

    function addService()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            // Display the registration form
            include(__DIR__ . '/views/addService.php');
        }
        // Perform some validation, like checking for empty fields or invalid values
        $msgError = "Error:";
        $hasError = false;
    
        $name = @$_REQUEST["name"];
        $description = @$_REQUEST["description"];
        $local = @$_REQUEST["local"];
        $price = @$_REQUEST["price"];
        $activity = @$_REQUEST["activity"];
    
        if (empty($name)) {
            $msgError .= ' Name not provided.';
            $hasError = true;
        }
        if (empty($description)) {
            $msgError .= ' Description not provided.';
            $hasError = true;
        }
        if (empty($local)) {
            $msgError .= ' Local not provided.';
            $hasError = true;
        }
        if (empty($price)) {
            $msgError .= ' Price not provided.';
            $hasError = true;
        } elseif (!is_numeric($price)) {
            $msgError .= ' Price must be a number.';
            $hasError = true;
        }
        if (empty($activity)) {
            $msgError .= ' Activity not provided.';
            $hasError = true;
        }
    
        if (!$hasError) {
            // If all fields are valid, proceed to insert the service
            $serviceData = [
                "name" => $name,
                "description" => $description,
                "local" => $local,
                "price" => $price,
                "activity" => $activity
            ];
    
            $insertResult = $this->serviceModel->createService($serviceData);
            if ($insertResult) {
                // Handle successful insertion, such as redirecting to a success page
                header('Location: /path/to/success/page');
                exit();
            } else {
                // Handle insertion failure
                RequestResult::requestERROR(RequestOperation::INSERT, "Failed to add service.")->toJsonEcho();
            }
        } else {
            // If there are validation errors
            RequestResult::requestERROR(RequestOperation::INSERT, $msgError)->toJsonEcho();
        }
    }
    

    function editService($id)
    {
        // Prepare the service data from the request
        $serviceData = array(
            "id"          => $id,
            "name"        => @$_REQUEST["name"],
            "description" => @$_REQUEST["description"],
            "local"       => @$_REQUEST["local"],
            "price"       => @$_REQUEST["price"],
            "activity"    => @$_REQUEST["activity"]
        );
    
        // Validation can be added here if necessary
    
        // Create an instance of the ServiceModel
        $serviceModel = new ServiceModel();
    
        // Call the update method on the service model
        $updateResult = $serviceModel->updateService($serviceData["id"], $serviceData);
    
        // Output the result as JSON
        $updateResult->toJsonEcho();
    }
    

    function listServices()
    {
        // Code to display a list of services
    }

    function deleteService($id)
    {
        // Create an instance of the ServiceModel
        $serviceModel = new ServiceModel();
    
        // Call the delete method on the service model
        $deleteResult = $serviceModel->deleteService($id);
    
        // Output the result as JSON
        $deleteResult->toJsonEcho();
    }
    
    function showServices() {
        $folder = __NAMESPACE__;
        include("./$folder/Views/showServices.php");
    }
    // Additional methods as needed
}
?>
