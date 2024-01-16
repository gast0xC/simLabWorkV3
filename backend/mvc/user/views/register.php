<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./backend/mvc/user/views/registerStyles.css">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">

</head>
<body>
    <div class="register-container">
         <form action="/webapp/app.php?service=registerUser" method="post"> 
        <!-- <form action="/user/register" method="post"> -->
            <h2>Register in Adrenaline Adventures</h2>

            <div class="form-group">
                <label for="name">Username:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <div class ="form-group">
                <label for="role">Role:</label>
                <select id="role" name="role">
                    <option value="client">Client</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <div class ="form-group">
                <label for="mail">Email:</label>
                <input type="mail" id="mail" name="mail" required>
            </div>

            <div class ="form-group">
                <label for="telephone">Phone Number:</label>
                <input type="telephone" id="telephone" name="telephone" required>
            </div>

            <div class ="form-group">
                <label for="money">Money:</label>
                <input type="money" id="money" name="money" required>
            </div>
            
            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>
