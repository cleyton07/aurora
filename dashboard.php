<?php
require_once 'config.php';

// Verificar se está logado
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Aurora Viagens</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #000000, #4b0082, #6a0dad);
            min-height: 100vh;
            color: white;
        }

        .header {
            background: rgba(0, 0, 0, 0.9);
            padding: 20px;
            border-bottom: 3px solid #6a0dad;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 2rem;
            color: #9370db;
            font-weight: bold;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .btn {
            padding: 10px 20px;
            background: #6a0dad;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s;
        }

        .btn:hover {
            background: #4b0082;
        }

        .welcome {
            text-align: center;
            padding: 100px 20px;
        }

        .welcome h1 {
            font-size: 3rem;
            margin-bottom: 20px;
            color: #9370db;
        }

        .welcome p {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="container">
            <div class="nav">
                <div class="logo">🌌 Aurora Viagens</div>
                <div class="user-info">
                    <span>Olá, <?php echo $_SESSION['usuario_nome']; ?>!</span>
                    <a href="logout.php" class="btn">Sair</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="welcome">
            <h1>Bem-vindo ao Sistema!</h1>
            <p>Login realizado com sucesso.</p>
            <p>Email: <?php echo $_SESSION['usuario_email']; ?></p>
            <p>ID do usuário: <?php echo $_SESSION['usuario_id']; ?></p>
        </div>
    </div>
</body>
</html>