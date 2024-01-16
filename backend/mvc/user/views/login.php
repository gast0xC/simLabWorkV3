

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <style>
        /* Add some basic styling */
        body {
            font-family: 'Arial', sans-serif;
            background-image: linear-gradient(45deg, #ff9a9e, #fad0c4, #fad0c4, #f6d365, #fda085, #f6d365);
            background-size: 300% 300%;
            animation: colorsBackgroundChange 10s ease infinite;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 0;
        }

        @keyframes colorsBackgroundChange {
            0%{background-position:0% 50%}
            50%{background-position:100% 50%}
            100%{background-position:0% 50%}
        }

        .login-container {
            width: 300px;
            padding: 40px;
            background-color: rgba(255, 255, 255, 0.85); /* Fundo translúcido para os elementos do formulário */
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Sombra para profundidade */
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        input[type="text"]:focus, input[type="password"]:focus {
            transform: scale(1.05);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); /* Sombra ao focar */
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease, box-shadow 0.3s ease-in-out;
        }
        input[type="submit"]:hover {
        background-color: #45a049;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); /* Sombra ao passar o mouse */
        }

        label {
            display: block;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div>
                <input type="submit" value="Login">
            </div>
        </form>
    </div>
</body>
</html>
