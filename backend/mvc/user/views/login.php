

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <style>
        /* Add some basic styling */
        body {
            font-family: 'Arial', sans-serif;
            background-image: linear-gradient(45deg, #0d47a1, #1b5e20, #b71c1c, #ff6f00);
            background-size: 400% 400%;
            animation: colorsBackgroundChange 15s ease infinite;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 0;
            transition: background-color 0.5s;
        }

        body:hover {
            background-color: #333; /* Escurece o fundo quando o mouse passa sobre a página */
        }

        @keyframes colorsBackgroundChange {
            0%{background-position:0% 50%}
            50%{background-position:100% 50%}
            100%{background-position:0% 50%}
        }

        .login-container {
            width: 300px;
            padding: 40px;
            background-color: rgba(0, 0, 0, 0.8); /* Fundo translúcido escuro para os elementos do formulário */
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.5); /* Sombra para profundidade */
            backdrop-filter: blur(5px); /* Efeito de desfoque no fundo do container */
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: rgba(255, 255, 255, 0.7); /* Fundo semi-transparente para inputs */
            transition: background-color 0.3s ease-in-out;
        }

        input[type="text"]:focus, input[type="password"]:focus {
            background-color: rgba(255, 255, 255, 1); /* Muda o fundo para branco ao focar */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.4); /* Sombra ao focar */
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #1b5e20; /* Verde escuro para o botão de submissão */
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease-in-out;
        }

        input[type="submit"]:hover {
            transform: scale(1.05); /* Aumenta o tamanho do botão ao passar o mouse */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.6); /* Sombra mais intensa ao passar o mouse */
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #aad; /* Cor clara para o texto do label */
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
