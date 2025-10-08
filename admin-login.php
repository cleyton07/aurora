<?php
session_start();
include_once '../config/database.php';

if($_POST) {
    $database = new Database();
    $db = $database->getConnection();

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $query = "SELECT * FROM administradores WHERE email = ?";
    $stmt = $db->prepare($query);
    $stmt->bindParam(1, $email);
    $stmt->execute();

    if($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if(password_verify($senha, $row['senha'])) {
            $_SESSION['admin_id'] = $row['id'];
            $_SESSION['admin_nome'] = $row['nome'];
            $_SESSION['admin_nivel'] = $row['nivel_acesso'];
            header("Location: dashboard.php");
            exit();
        }
    }
    $erro = "Email ou senha inválidos";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - Admin Aurora Viagens</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            background: linear-gradient(135deg, #6a0dad, #4b0082);
            display: flex; 
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
            margin: 0; 
        }
        .login-container { 
            background: white; 
            padding: 2rem; 
            border-radius: 10px; 
            box-shadow: 0 0 20px rgba(0,0,0,0.2); 
            width: 300px; 
        }
        .form-group { 
            margin-bottom: 1rem; 
        }
        label { 
            display: block; 
            margin-bottom: 0.5rem; 
        }
        input { 
            width: 100%; 
            padding: 0.5rem; 
            border: 1px solid #ddd; 
            border-radius: 5px; 
        }
        button { 
            width: 100%; 
            padding: 0.7rem; 
            background: #6a0dad; 
            color: white; 
            border: none; 
            border-radius: 5px; 
            cursor: pointer; 
        }
        .error { 
            color: red; 
            text-align: center; 
            margin-bottom: 1rem; 
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2 style="text-align: center; color: #6a0dad;">Aurora Viagens</h2>
        <h3 style="text-align: center;">Painel Administrativo</h3>
        
        <?php if(isset($erro)): ?>
            <div class="error"><?php echo $erro; ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Senha:</label>
                <input type="password" name="senha" required>
            </div>
            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>