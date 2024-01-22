<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Best Deals</title>
  <script src="public/responsivity/responsivity.js"></script>
  <style>
    /* Similar styling as showServices.php */
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
  <h1>Top 3 Best Deals</h1>
  <table id="tableBestDeals">
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
  ajax_post_request("app.php?service=selectBestDeals", "", function(result) {
    const deals = JSON.parse(result);
    var table = document.getElementById("tableBestDeals");
    
    if (deals.result == deals.resultTypes.SUCCESS) {
      deals.data.forEach((deal) => {
        var row = table.insertRow();
        row.insertCell().innerHTML = deal.id;
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
