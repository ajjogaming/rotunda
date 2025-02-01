<?php
session_start();

// Using hashed password for "rotundacka" 
define('HASHED_PASSWORD', '$2y$10$RrBrPE5n7LBqeB1YxuCY5eozbraIpH8L4kEdJTp8Shj0FX6Bbi5DG'); // Generated from password_hash("rotundacka", PASSWORD_BCRYPT)

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST["password"] ?? "";

    if (password_verify($password, HASHED_PASSWORD)) {
        $_SESSION["loggedin"] = true;
        header("Location: index.php");
        exit();
    } else {
        echo "<script>alert('Nope! Skús znova 😉'); window.location.href = 'login.php';</script>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rotunda Login</title>
    <link rel="preload" href="critical.css" as="style" importance="high">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
            max-width: 400px;
            width: 90%;
        }
        .password-container {
            position: relative;
        }
        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
    <script src="preloader.js"></script>
    <script>
        // Start preloading as soon as possible
        document.addEventListener('DOMContentLoaded', () => {
            preloadAssets()
                .then(() => {
                    console.log('All assets preloaded successfully');
                })
                .catch(error => {
                    console.log('Error preloading assets:', error);
                });
        });
    </script>
</head>
<body>
    <div class="login-card">
        <h2 class="text-center mb-4">👋 Ahojkyyyy!</h2>
        <p class="text-center mb-4">Práve si na testovacej stránke Rotundy.<br>Uhádni heslo, a si tam! 🎯</p>
        
        <form method="post">
            <div class="form-group mb-3">
                <label class="form-label">Heslo:</label>
                <div class="password-container">
                    <input type="password" name="password" id="password" class="form-control" required>
                    <i class="toggle-password fas fa-eye" onclick="togglePassword()"></i>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100">Prihlásiť sa</button>
        </form>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.querySelector('.toggle-password');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
