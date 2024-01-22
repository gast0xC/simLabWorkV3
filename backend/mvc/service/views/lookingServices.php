<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Search Services by Activity</title>
  <script src="public/responsivity/responsivity.js"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');

    /* Reset básico para garantir consistência entre navegadores */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    body {
        font-family: 'Roboto', sans-serif;
        background-image: linear-gradient(120deg, #002b36, #2aa198, #268bd2, #002b36);
        color: #333;
        text-align: center;
        padding: 50px;
        height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background-size: 300% 300%;
        animation: gradientShift 20s ease infinite;
    }

    @keyframes gradientShift {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    h1 {
        font-size: 2.5em;
        margin-bottom: 20px;
        color: #fff;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        animation: fadeInDown 2s ease-in-out;
    }

    @keyframes fadeInDown {
        0% {
            opacity: 0;
            transform: translateY(-30px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .search-container {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }

    input[type="text"] {
        font-size: 1em;
        padding: 10px;
        width: 40%;  /* Smaller width */
        max-width: 300px;  /* Maximum width */
        border: 2px solid #2aa198;
        border-radius: 4px;
        transition: transform 0.2s ease, box-shadow 0.3s ease;
    }

    input[type="button"] {
        font-size: 1em;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        background-color: #268bd2;
        color: white;
        margin-left: -1px; /* Align with the search bar */
        transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease-in-out;
    }

    input[type="button"]:hover {
        background-color: #0077b3;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    table {
        border-collapse: collapse;
        width: 80%;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        border-radius: 8px;
        overflow: hidden;
        margin-top: 20px;
    }

    th, td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #00796b;
        color: white;
    }

    tr:hover:not(:first-child) {
        background-color: #f2f2f2;
        transform: scale(1.02);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
