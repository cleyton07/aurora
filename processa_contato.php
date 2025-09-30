<?php
session_start();
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitizar e validar dados
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING);
    $assunto = filter_input(INPUT_POST, 'assunto', FILTER_SANITIZE_STRING);
    $mensagem = filter_input(INPUT_POST, 'mensagem', FILTER_SANITIZE_STRING);

    // Validações
    $erros = [];

    if (empty($nome)) {
        $erros[] = "Nome é obrigatório";
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erros[] = "E-mail válido é obrigatório";
    }

    if (empty($mensagem)) {
        $erros[] = "Mensagem é obrigatória";
    }

    if (empty($erros)) {
        try {
            // Inserir no banco de dados
            $sql = "INSERT INTO contatos (nome, email, telefone, assunto, mensagem) 
                    VALUES (:nome, :email, :telefone, :assunto, :mensagem)";
            
            $stmt = $pdo->prepare($sql);
            
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':telefone', $telefone);
            $stmt->bindParam(':assunto', $assunto);
            $stmt->bindParam(':mensagem', $mensagem);
            
            if ($stmt->execute()) {
                $_SESSION['mensagem'] = "Mensagem enviada com sucesso! Entraremos em contato em breve.";
                $_SESSION['tipo_mensagem'] = "sucesso";
            } else {
                $_SESSION['mensagem'] = "Erro ao enviar mensagem. Tente novamente.";
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
    
    header("Location: contato.php");
    exit();
}
?>