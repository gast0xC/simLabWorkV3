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
      position: absolute;
      left: 50px;
      top: 10px;
      width: 70%
    }
    table {
      border-collapse: collapse;
      width: 100%;
      background-color: lightgrey;
    }
    th, td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid green;
    }

    tr:hover {
      background-color: coral;
    }
    tr:nth-child(1):hover{
      background-color: lightyellow;
    }
  </style>
</head>

<body>
  <h1>Services in the database</h1>
  <label id="msgStatus"></label>
  <input type="button" value="Add Service" onclick="addService();" style="margin:5px">
  
  <table id="tableServices">
    <thead>
      <tr>
        <th>Id</th>
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
  ajax_post_request("app.php?service=selectAllServices", "", function(result) {
    const services = JSON.parse(result);
    var table = document.getElementById("tableServices");

    if (services.result == services.resultTypes.SUCCESS) {
      services.data.forEach((service) => {
        var row = table.insertRow();
        row.insertCell().innerHTML = service.id;
        row.insertCell().innerHTML = service.name;
        row.insertCell().innerHTML = service.description;
        row.insertCell().innerHTML = service.local;
        row.insertCell().innerHTML = service.price;
        row.insertCell().innerHTML = service.activity;

        let btnSee = document.createElement("button");
        btnSee.innerHTML = "See";
        btnSee.onclick = function() {
          seeService(service.id)
        };
        let btnUpdate = document.createElement("button");
        btnUpdate.innerHTML = "Update";
        btnUpdate.onclick = function() {
          updateService(service.id)
        };

        let btnDelete = document.createElement("button");
        btnDelete.innerHTML = "Delete";    
        btnDelete.onclick = function() {
          deleteService(service.id)
        };

        let actionsCell = row.insertCell();
        actionsCell.appendChild(btnSee);
        actionsCell.appendChild(btnUpdate);
        actionsCell.appendChild(btnDelete);
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

</script>

</body>
</html>
