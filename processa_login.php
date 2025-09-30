<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $senha = $_POST['senha'];

    // Validações
    $erros = [];

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erros[] = "E-mail válido é obrigatório";
    }

    if (empty($senha)) {
        $erros[] = "Senha é obrigatória";
    }

    if (empty($erros)) {
        try {
            // Buscar usuário no banco
            $sql = "SELECT id, nome, email, senha FROM usuarios WHERE email = :email";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            if ($stmt->rowCount() == 1) {
                $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
                
                // Verificar senha
                if (password_verify($senha, $usuario['senha'])) {
                    // Login bem-sucedido
                    $_SESSION['usuario_id'] = $usuario['id'];
                    $_SESSION['usuario_nome'] = $usuario['nome'];
                    $_SESSION['usuario_email'] = $usuario['email'];
                    $_SESSION['logado'] = true;
                    
                    $_SESSION['mensagem'] = "Login realizado com sucesso!";
                    $_SESSION['tipo_mensagem'] = "sucesso";
                    header("Location: dashboard.php");
                    exit();
                } else {
                    $_SESSION['mensagem'] = "Senha incorreta.";
                    $_SESSION['tipo_mensagem'] = "erro";
                }
            } else {
                $_SESSION['mensagem'] = "Usuário não encontrado.";
                $_SESSION['tipo_mensagem'] = "erro";
            }
            
        } catch(PDOException $e) {
            $_SESSION['mensagem'] = "Erro no banco de dados: " . $e->getMessage();
            $_SESSION['tipo_mensagem'] = "erro";
        }
    } else {
        $_SESSION['mensagem'] = implode("<br>", $erros);
        $_SESSION['tipo_mensagem'] = "erro";
    }
    
    header("Location: login.php");
    exit();
}
?>