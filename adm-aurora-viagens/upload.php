<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $tipo = $_POST['tipo'];

    $pasta = "uploads/";
    if (!file_exists($pasta)) {
        mkdir($pasta, 0777, true);
    }

    $imagem = $_FILES['imagem']['name'];
    $tmp = $_FILES['imagem']['tmp_name'];
    $destino = $pasta . basename($imagem);

    if (move_uploaded_file($tmp, $destino)) {
        $sql = "INSERT INTO locais (nome, descricao, tipo, imagem) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nome, $descricao, $tipo, $destino]);
        header("Location: listar.php?msg=success");
    } else {
        echo "Erro ao enviar a imagem.";
    }
}
?>