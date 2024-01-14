
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Service</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="public/responsivity/responsivity.js"></script>
</head>

<body style="left:100px; top:100px; width:70%;  padding:50px; background-color:gray">
    <label id="msgStatus" style="margin-bottom:5px; padding:5px; background-color:burlywood; display:none;"></label>
    <form id="form" style="padding:50px; background-color:darkcyan">
        <!-- Add appropriate fields for service -->
        <div class="form-group row">
            <label for="name" class="col-4 col-form-label">Service Name</label>
            <div class="col-8">
                <input id="name" name="name" type="text" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="description" class="col-4 col-form-label">Description</label>
            <div class="col-8">
                <input id="description" name="description" type="text" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="local" class="col-4 col-form-label">Local</label>
            <div class="col-8">
                <input id="local" name="local" type="text" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="price" class="col-4 col-form-label">Price</label>
            <div class="col-8">
                <input id="price" name="price" type="text" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="activity" class="col-4 col-form-label">Activity</label>
            <div class="col-8">
                <input id="activity" name="activity" type="text" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <div class="offset-4 col-8">
                <button type="button" id="button" name="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
        <input type="hidden" id="id" name="id" value="-1"> <!-- service id -->
    </form>

    <script>
    const QueryString = window.location.search;
    const urlParams = new URLSearchParams(QueryString);
    var mode = "";
    var id = "";

    // Determine the mode from the URL parameters
    if (urlParams.get('MODE') !== null) {
        mode = urlParams.get('MODE');
        switch (mode) {
            case "INSERT":
                setFormEditable(true);
                
                document.getElementById('Service Name').readOnly = false;
                document.getElementById('Description').readOnly = false;
                document.getElementById('Local').readOnly = false;
                document.getElementById('Price').readOnly = false;
                document.getElementById('Activity').readOnly = false;
                document.getElementById('button').innerText = "Add";
                document.getElementById('button').onclick = submitNewServiceData;
                break;
            case "SEE":
                setFormEditable(false);
                document.getElementById('button').innerText = "Go back";
                document.getElementById('button').onclick = function() {
                    window.location.href = "app.php?service=showServicesAsTable";
                };
                break;
            case "UPDATE":
                setFormEditable(true);
                document.getElementById('button').innerText = "Update";
                document.getElementById('button').style.backgroundColor = "red"; 
                document.getElementById('button').onclick = updateService;
                break;
            case "DELETE":
                setFormEditable(false);
                document.getElementById('button').innerText = "DELETE";
                document.getElementById('button').style.backgroundColor = "red"; 
                id = urlParams.get('id');
                document.getElementById('button').onclick = function() { deleteService(id); };
                break;
        }

        if (["UPDATE", "SEE", "DELETE"].includes(mode)) {
            id = urlParams.get('id');
            fetchService(id);
        }
    }

    function setFormEditable(isEditable) {
        ['name', 'description', 'local', 'price', 'activity'].forEach(field => {
            document.getElementById(field).readOnly = !isEditable;
        });
    }//TESTESTE

    function submitNewServiceData() {
        const form = document.getElementById('form');
        const formData = new FormData(form);
        ajax_post_request("app.php?service=insertServiceFromView", formData,
            function success(result) {
                handleResult(result, "Added new service with id = ");
            },
            function error(error) {
                displayStatus(error);
            }
        );
    }

    function fetchService(id) {
        ajax_post_request("app.php?service=selectService&id=" + id, "",
            function success(result) {
                const requestResult = JSON.parse(result);
                if (requestResult.result == requestResult.resultTypes.SUCCESS) {
                    displayStatus("Fetched service with id = " + requestResult.data[0].id);
                    ['id', 'name', 'description', 'local', 'price', 'activity'].forEach(field => {
                        document.getElementById(field).value = requestResult.data[0][field];
                    });
                } else {
                    displayStatus(requestResult.msg);
                }
            },
            function error(error) {
                displayStatus(error);
            }
        );
    }

    function updateService() {
        const form = document.getElementById('form');
        const formData = new FormData(form);
        ajax_post_request("app.php?service=updateService", formData,
            function success(result) {
                handleResult(result, "Updated service with id = ");
            },
            function error(error) {
                displayStatus(error);
            }
        );
    }

    function deleteService(id) {
        ajax_post_request("app.php?service=deleteService&id=" + id, "",
            function success(result) {
                handleResult(result, "Deleted service with id = ");
            },
            function error(error) {
                displayStatus(error);
            }
        );
    }

    function displayStatus(message) {
        const statusLabel = document.getElementById("msgStatus");
        statusLabel.innerHTML = message;
        statusLabel.style.display = "block";
    }

    function handleResult(result, successMessagePrefix) {
        const requestResult
        = JSON.parse(result);
        if (requestResult.result == requestResult.resultTypes.SUCCESS) {
            displayStatus(successMessagePrefix + requestResult.id);
            document.getElementById('button').innerText = "Go back";
            document.getElementById('button').style.backgroundColor = "Blue";
            document.getElementById('button').onclick = function() {
            window.location.href = "app.php?service=showServices";
        };
        } else {
            displayStatus(requestResult.msg);
        }
    }
</script>

</body>
</html>