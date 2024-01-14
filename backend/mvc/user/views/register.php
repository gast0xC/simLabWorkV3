<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="register-container">
         <form action="/webapp/app.php?service=registerUser" method="post"> 
            <h2>Register</h2>

            <label for="name">Username:</label>
            <input type="text" id="name" name="name" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="role">Role:</label>
            <select id="role" name="role">
                <option value="client">Client</option>
                <option value="admin">Admin</option>
            </select>

            <label for="mail">Email:</label>
            <input type="mail" id="mail" name="mail" required>

            <label for="telephone">Phone Number:</label>
            <input type="telephone" id="telephone" name="telephone" required>

            <label for="money">money:</label>
            <input type="money" id="money" name="money" required>

            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>
