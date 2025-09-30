<?php
require_once 'config.php';

$erro = '';
$sucesso = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];
    $confirmar_senha = $_POST['confirmar_senha'];

    // Validações
    if (empty($nome) || empty($email) || empty($senha)) {
        $erro = "Todos os campos são obrigatórios!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = "E-mail inválido!";
    } elseif ($senha !== $confirmar_senha) {
        $erro = "As senhas não coincidem!";
    } elseif (strlen($senha) < 6) {
        $erro = "A senha deve ter pelo menos 6 caracteres!";
    } else {
        try {
            // Verificar se email já existe
            $sql = "SELECT id FROM usuarios WHERE email = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$email]);
            
            if ($stmt->rowCount() > 0) {
                $erro = "Este e-mail já está cadastrado!";
            } else {
                // Hash da senha
                $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
                
                // Inserir usuário
                $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
                $stmt = $pdo->prepare($sql);
                
                if ($stmt->execute([$nome, $email, $senha_hash])) {
                    $sucesso = "Cadastro realizado com sucesso! <a href='login.php'>Faça login aqui</a>";
                }
            }
        } catch(PDOException $e) {
            $erro = "Erro no cadastro: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Aurora Viagens</title>
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
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            background: rgba(0, 0, 0, 0.9);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 0 30px rgba(106, 13, 173, 0.5);
            border: 2px solid #6a0dad;
            width: 100%;
            max-width: 450px;
        }

        .logo {
            text-align: center;
            margin-bottom: 30px;
            color: #9370db;
        }

        .logo h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .logo p {
            color: #aaa;
            font-size: 1.1rem;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #9370db;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #4b0082;
            border-radius: 8px;
            background: #1a1a1a;
            color: white;
            font-size: 16px;
            transition: all 0.3s;
        }

        input:focus {
            outline: none;
            border-color: #9370db;
            box-shadow: 0 0 10px rgba(147, 112, 219, 0.5);
        }

        .btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #6a0dad, #4b0082);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
        }

        .btn:hover {
            background: linear-gradient(135deg, #4b0082, #6a0dad);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(106, 13, 173, 0.4);
        }

        .links {
            text-align: center;
            margin-top: 20px;
        }

        .links a {
            color: #9370db;
            text-decoration: none;
            transition: color 0.3s;
        }

        .links a:hover {
            color: #6a0dad;
            text-decoration: underline;
        }

        .mensagem {
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: bold;
        }

        .erro {
            background: rgba(255, 0, 0, 0.1);
            border: 1px solid #ff4444;
            color: #ff6b6b;
        }

        .sucesso {
            background: rgba(0, 255, 0, 0.1);
            border: 1px solid #00cc00;
            color: #90ee90;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <h1>🌌 Aurora Viagens</h1>
            <p>Crie sua conta</p>
        </div>

        <?php if ($erro): ?>
            <div class="mensagem erro"><?php echo $erro; ?></div>
        <?php endif; ?>

        <?php if ($sucesso): ?>
            <div class="mensagem sucesso"><?php echo $sucesso; ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="nome">Nome Completo</label>
                <input type="text" id="nome" name="nome" required value="<?php echo isset($_POST['nome']) ? htmlspecialchars($_POST['nome']) : ''; ?>">
            </div>

            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
            </div>

            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" required minlength="6">
            </div>

            <div class="form-group">
                <label for="confirmar_senha">Confirmar Senha</label>
                <input type="password" id="confirmar_senha" name="confirmar_senha" required minlength="6">
            </div>

            <button type="submit" class="btn">Cadastrar</button>
        </form>

        <div class="links">
            <p>Já tem uma conta? <a href="login.php">Faça login</a></p>
        </div>
    </div>
</body>
</html>