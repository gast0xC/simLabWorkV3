<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Best Deals</title>
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
        background-image: linear-gradient(45deg, #2c3e50, #4ca1af);
        color: #333;
        text-align: center;
        padding: 50px;
        height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    h1 {
        font-size: 2.5em;
        color: #fff;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        margin-bottom: 20px;
        animation: fadeInDown 2s ease-in-out, pulse 1s infinite alternate;
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

    @keyframes pulse {
        0% {
            transform: scale(1);
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }
        100% {
            transform: scale(1.1);
            text-shadow: 0 4px 8px rgba(0, 0, 0, 0.6);
        }
    }

    table {
        border-collapse: collapse;
        width: 80%;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        border-radius: 8px;
        overflow: hidden;
        margin: 20px auto;
    }

    th, td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #00796b;
        color: white;
        position: sticky;
        top: 0;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    tr:hover:not(:first-child) {
        background-color: #f2f2f2;
        transform: scale(1.02);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>
<body>
  <h1>Top 3 Best Deals</h1>
  <table id="tableBestDeals">
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
  ajax_post_request("app.php?service=selectBestDeals", "", function(result) {
    const deals = JSON.parse(result);
    var table = document.getElementById("tableBestDeals");
    
    if (deals.result == deals.resultTypes.SUCCESS) {
      deals.data.forEach((deal) => {
        var row = table.insertRow();
        
        row.insertCell().innerHTML = deal.name;
        row.insertCell().innerHTML = deal.description;
        row.insertCell().innerHTML = deal.local;
        row.insertCell().innerHTML = deal.price;
        row.insertCell().innerHTML = deal.activity;
      });
    } else {
      console.log("Error: " + deals.msg);
    }
  });
  </script>
</body>
</html>
