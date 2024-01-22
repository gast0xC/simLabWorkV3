<?php
require_once 'backend/library/auth_aux.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Services</title>
  <script src="public/responsivity/responsivity.js"></script>
  <style>
        body {
            font-family: 'Arial', sans-serif;
            background-image: linear-gradient(120deg, #3a1c71, #d76d77, #ffaf7b);
            color: #333;
            text-align: center;
            padding: 20px;
            transition: background-color 0.5s ease;
        }


        h1 {
            color: #fff;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            margin-bottom: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            background-color: #fff; /* Background color for the table */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Shadow for the table */
            border-radius: 8px; /* Rounded corners for the table */
            overflow: hidden; /* Ensures the border-radius clips the content */
            margin-bottom: 20px;
            transition: transform 0.3s ease-in-out;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            transition: background-color 0.3s ease;
        }

        th {
            background-color: #00796b;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
            transform: scale(1.02);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        tr:nth-child(1):hover{
            background-color: lightyellow;
        }

        button {
            padding: 10px 15px;
            margin-right: 8px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        button:hover {
            transform: translateY(-3px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        #buttonContainer input[type="button"] {
            background-color: #4CAF50;
            color: white;
        }

        #buttonContainer input[type="button"]:hover {
            background-color: #45a049;
        }
    </style>

<script>

    <?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    // Set JavaScript variables based on PHP session role
    echo "var isUserAdmin = " . (isset($_SESSION['role']) && $_SESSION['role'] === 'admin' ? 'true' : 'false') . ";";
    echo "var isUserClient = " . (isset($_SESSION['role']) && $_SESSION['role'] === 'client' ? 'true' : 'false') . ";";
    ?>
</script>


</head>

<body>
  <h1>Available Services</h1>

  <label id="msgStatus"></label>
  
 <div id="buttonContainer" style="margin:5px"></div>

  
  <table id="tableServices">
    <thead>
      <tr>
        
        <th>Name</th>
        <th>Description</th>
        <th>Local</th>
        <th>Price</th>
        <th>Activity</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
  <script>
        document.addEventListener("DOMContentLoaded", function() {
      if (isUserAdmin) {
        var btnAddService = document.createElement("input");
        btnAddService.type = "button";
        btnAddService.value = "Add Service";
        btnAddService.onclick = function() { addService(); };
        btnAddService.style.margin = "5px";

        var buttonContainer = document.getElementById("buttonContainer");
        buttonContainer.appendChild(btnAddService);
      }
    });

    ajax_post_request("app.php?service=selectAllServices", "", function(result) {
    const services = JSON.parse(result);
    var table = document.getElementById("tableServices");

    if (services.result == services.resultTypes.SUCCESS) {
      services.data.forEach((service) => {
        var row = table.insertRow();
        
        row.insertCell().innerHTML = service.name;
        row.insertCell().innerHTML = service.description;
        row.insertCell().innerHTML = service.local;
        row.insertCell().innerHTML = service.price;
        row.insertCell().innerHTML = service.activity;

        let actionsCell = row.insertCell();

        // Create "See" button for all users
        let btnSee = document.createElement("button");
        btnSee.innerHTML = "See";
        btnSee.onclick = function() { seeService(service.id); };
        actionsCell.appendChild(btnSee);

        if (isUserAdmin) {
          // Admin-specific buttons
          let btnUpdate = document.createElement("button");
          btnUpdate.innerHTML = "Update";
          btnUpdate.onclick = function() { updateService(service.id); };
          let btnDelete = document.createElement("button");
          btnDelete.innerHTML = "Delete";
          btnDelete.onclick = function() { deleteService(service.id); };
          actionsCell.appendChild(btnUpdate);
          actionsCell.appendChild(btnDelete);
        } else if (isUserClient) {
          // Client-specific "Buy" button
          let btnBuy = document.createElement("button");
          btnBuy.innerHTML = "Buy";
          btnBuy.onclick = function() { buyService(service.id); };
          actionsCell.appendChild(btnBuy);
        }
      });
    } else {
      document.getElementById("msgStatus").innerHTML = services.msg;
    }
  });

  function addService() {
    window.location.href = "app.php?service=addService&MODE=INSERT";
  }

  function seeService(id) {
    window.location.href = `app.php?service=addService&id=${id}&MODE=SEE`;
  }

  function updateService(id) {
    window.location.href = `app.php?service=addService&id=${id}&MODE=UPDATE`;
  }
  
  function deleteService(id) {
    window.location.href = `app.php?service=addService&id=${id}&MODE=DELETE`;
  }

  function buyService(id) {
    // Implementation of buyService functionality
    console.log("Buy service with ID:", id);
    // For example, redirect to a purchase page
    // window.location.href = `app.php?service=buyService&id=${id}`;
  }


</script>

</body>
</html>
