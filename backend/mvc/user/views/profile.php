<?php

    namespace backend\mvc\user;

    use \backend\library\Controller;
    use \backend\library\RequestOperation;
    use \backend\library\RequestResult;

    use \backend\mvc\user\UserModel;
    use \Exception;


    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['name'])) {
        // Redirect to login page if not logged in
        header('Location: login.php');
        exit();
    }

    $userModel = new UserModel();
    $userData = $userModel->selectUserByName($_SESSION['name']);

    if ($userData->result !== RequestOperation::SUCCESS->value) {
        // Handle the case where the user data couldn't be fetched
        die("Error fetching user data: " . $userData->msg);
    }

    // Assuming $userData->data contains the user information
    $userInfo = $userData->data;
?>




<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
    <!-- Add styles and scripts if needed -->
    <link rel="stylesheet" href="./backend/mvc/user/views/profileStyles.css">
</head>
<body>

<h1>Edit Profile</h1>
<form action="/webapp/app.php?service=profile" method="post">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($userInfo['email']); ?>" required>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password">

    <label for="money">Money:</label>
    <input type="text" id="money" name="money" value="<?php echo htmlspecialchars($userInfo['money']); ?>">

    <input type="submit" value="Update Profile">
</form>

</body>
</html>
