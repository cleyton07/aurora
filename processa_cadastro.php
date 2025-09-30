<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitizar e validar dados
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $senha = $_POST['senha'];
    $confirmar_senha = $_POST['confirmar_senha'];

    // Validações
    $erros = [];

    if (empty($nome)) {
        $erros[] = "Nome é obrigatório";
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erros[] = "E-mail válido é obrigatório";
    }

    if (empty($senha)) {
        $erros[] = "Senha é obrigatória";
    }

    if ($senha !== $confirmar_senha) {
        $erros[] = "As senhas não coincidem";
    }

    if (strlen($senha) < 6) {
        $erros[] = "A senha deve ter pelo menos 6 caracteres";
    }

    if (empty($erros)) {
        try {
            // Verificar se email já existe
            $sql = "SELECT id FROM usuarios WHERE email = :email";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $_SESSION['mensagem'] = "Este e-mail já está cadastrado.";
                $_SESSION['tipo_mensagem'] = "erro";
            } else {
                // Hash da senha
                $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

                // Inserir no banco de dados
                $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
                $stmt = $pdo->prepare($sql);
                
                $stmt->bindParam(':nome', $nome);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':senha', $senha_hash);

                if ($stmt->execute()) {
                    $_SESSION['mensagem'] = "Cadastro realizado com sucesso! Faça login para continuar.";
                    $_SESSION['tipo_mensagem'] = "sucesso";
                    header("Location: login.php");
                    exit();
                }
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