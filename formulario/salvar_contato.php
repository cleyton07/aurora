<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "formulario_contatos";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $conn->real_escape_string($_POST['nome']);
    $email = $conn->real_escape_string($_POST['email']);
    $telefone = $conn->real_escape_string($_POST['telefone']);
    $assunto = $conn->real_escape_string($_POST['assunto']);
    $mensagem = $conn->real_escape_string($_POST['mensagem']);

    $sql = "INSERT INTO mensagems (nome, email, telefone, assunto, mensagem)
            VALUES ('$nome', '$email', '$telefone', '$assunto', '$mensagem')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Mensagem enviada com sucesso!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Erro ao enviar mensagem.'); window.history.back();</script>";
    }
}

$conn->close();
?>
