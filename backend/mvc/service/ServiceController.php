<?php

namespace backend\mvc\service;

use backend\library\Controller;
use backend\library\RequestOperation;
use backend\library\RequestResult;

use backend\mvc\service\ServiceModel;
use Exception;


class ServiceController extends Controller
{
    function __construct()
    {
        // Constructor code here
    }

// Function to select all services or filter by certain criteria
function selectAll()
{
    $serviceModel = new ServiceModel();

    // If you plan to use filters, ensure these are correctly implemented.
    // Assuming you want to filter by id and name, the parameters should be correctly obtained from $_REQUEST
    $id   = @$_REQUEST["id"];
    $name = @$_REQUEST["name"];  

    // Call selectAll with appropriate parameters
    // Modify ServiceModel->selectAll method accordingly if it expects these parameters
    $serviceModel->selectAll($id, $name)->toJsonEcho();
}

function selectBestDeals()
{
    $serviceModel = new ServiceModel();

    $serviceModel->selectBestDeals()->toJsonEcho();
}   // Function to select a service by ID

function searchByActivity($activity) {
    $serviceModel = new ServiceModel();
    $serviceModel->searchByActivity($activity)->toJsonEcho();
}


    // Function to show services in a table
    function showServicesAsTable() {
        $folder = __NAMESPACE__;
        include("./$folder/Views/showServices.php");
    }

    
    function lookingFor() {
        $folder = __NAMESPACE__;
        include("./$folder/Views/lookingServices.php");
    }
    
    
    function bestDeals() {
        $folder = __NAMESPACE__;
        include("./$folder/views/bestDeals.php");
    }

    // Function to insert a service from a view
    function insertFromView() {
        $msgError = "Error:";
        $hasError = false;
        if(empty( @$_REQUEST["name"]) ) {
            $msgError .= ' name not provided.';
            $hasError  = true;
        } else if(empty( @$_REQUEST["description"]) ) {
            $msgError .= ' description not provided.';
            $hasError  = true;
        } else if(empty( @$_REQUEST["local"]) ) {
            $msgError .= ' local not provided.';
            $hasError  = true;
        }else if(empty( @$_REQUEST["price"]) ) {
            $msgError .= ' price not provided.';
            $hasError  = true;
        }else if(empty( @$_REQUEST["activity"]) ) {
            $msgError .= ' activity not provided.';
            $hasError  = true;
        }

        if(!$hasError) {
            $this->insert();
        } else {
            RequestResult::requestERROR(RequestOperation::INSERT, $msgError)->toJsonEcho();
        }
    }
/*name
description
local
price
activity*/
    // Function to insert a service
    function insert() {
        $requestData = [
            "name"       => @$_REQUEST["name"],
            "description"    => @$_REQUEST["description"],
            "local"       => @$_REQUEST["local"],
            "price" => @$_REQUEST["price"],
            "activity" => @$_REQUEST["activity"] 
        ];
        $serviceModel = new ServiceModel();
        $serviceModel->insert($requestData)->toJsonEcho();
    }

    // Function to show service form
    function showServiceForm($mode, $id) {
        $_GET['MODE']=$mode;
        $_GET['id']  = $id;
        $folder = __NAMESPACE__;
        include("./$folder/views/addService.php"); //MODE: INSERT, UPDATE, SEE
    }

    // Function to select a service by ID
    function select($id) {
        $serviceModel = new ServiceModel();
        $serviceModel->select($id)->toJsonEcho();
    }

    // Function to update a service
    function update() {
        $requestData = [
            "name"       => @$_REQUEST["name"],
            "id"       => @$_REQUEST["id"],
            "description"    => @$_REQUEST["description"],
            "local"       => @$_REQUEST["local"],
            "price" => @$_REQUEST["price"],
            "activity" => @$_REQUEST["activity"] 
        ];
        $serviceModel = new ServiceModel();
        $serviceModel->update($requestData)->toJsonEcho();
    }

    // Function to delete a service
    function delete($id) {
        $serviceModel = new ServiceModel();
        $serviceModel->delete($id)->toJsonEcho();
    }
    function buyService($id) {
        $serviceModel = new ServiceModel();
        $result = $serviceModel->buyService($id);
        $result->toJsonEcho();
    }
    
    
    
    // Additional functions as per your application's requirements
}
?>
