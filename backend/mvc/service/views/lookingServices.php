<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Search Services by Activity</title>
  <script src="public/responsivity/responsivity.js"></script>
  <style>
    /* Your CSS styles */
    body {
      position: absolute;
      left: 50px;
      top: 10px;
      width: 70%;
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
  </style>
</head>
<body>
  <h1>Search Services by Activity</h1>
  <input type="text" id="activitySearch" placeholder="Enter activity...">
  <input type="button" value="Search" onclick="searchActivity();">
  
  <table id="tableServices">
    <thead>
      <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Description</th>
        <th>Local</th>
        <th>Price</th>
        <th>Activity</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>

  <script>
function searchActivity() {
  var activity = document.getElementById("activitySearch").value.trim(); 
  console.log("Searching for activity:", activity); 

  // Append 'activity' as a query parameter in the URL
  var url = "app.php?service=searchByActivity&activity=" + encodeURIComponent(activity);

  ajax_post_request(url, "", 
    function success(result) {
      try {
        console.log("Response from server:", result); 
        const requestResult = JSON.parse(result);

        var table = document.getElementById("tableServices");
        var tbody = table.getElementsByTagName('tbody')[0];
        tbody.innerHTML = ""; 

        if (requestResult.result == requestResult.resultTypes.SUCCESS) {
          if (requestResult.data.length > 0) {
            requestResult.data.forEach((service) => {
              var row = tbody.insertRow();
              row.insertCell().innerHTML = service.id;
              row.insertCell().innerHTML = service.name;
              row.insertCell().innerHTML = service.description;
              row.insertCell().innerHTML = service.local;
              row.insertCell().innerHTML = service.price;
              row.insertCell().innerHTML = service.activity;
            });
          } else {
            var row = tbody.insertRow();
            var cell = row.insertCell();
            cell.colSpan = 6; 
            cell.innerHTML = "No matching services found.";
          }
        } else {
          document.getElementById("msgStatus").innerHTML = requestResult.msg;
          document.getElementById("msgStatus").style.display = "block";
        }
      } catch (e) {
        console.error("Failed to parse JSON. Error: ", e);
        document.getElementById("msgStatus").innerHTML = "Error parsing response";
        document.getElementById("msgStatus").style.display = "block";
      }
    },
    function error(errorMsg) {
      document.getElementById("msgStatus").innerHTML = errorMsg;
      document.getElementById("msgStatus").style.display = "block";
    });
}








  </script>
</body>
</html>
