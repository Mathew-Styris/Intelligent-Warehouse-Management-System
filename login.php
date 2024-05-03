<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: #fff;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background-color: #333;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            max-width: 400px;
            width: 100%;
            animation: slide-in 0.5s ease;
        }
        @keyframes slide-in {
            from {
                opacity: 0;
                transform: translateY(-50%);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        h2 {
            text-align: center;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #666;
            border-radius: 5px;
            margin-bottom: 20px;
            box-sizing: border-box;
            background-color: #444;
            color: #fff;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .error-message {
            color: red;
            margin-top: -10px;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <?php if (isset($_GET['error']) && $_GET['error'] === 'invalid'): ?>
            <p class="error-message">Invalid username or password.</p>
        <?php endif; ?>
        <form action="login_process.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>
