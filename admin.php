<?php
session_start();
require_once 'config.php';

// Verificar se é admin (em produção, implementar sistema de login)
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Contatos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #000;
            color: #fff;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #6a0dad;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #4b0082;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #1a1a1a;
        }
        h1 {
            color: #9370db;
        }
    </style>
</head>
<body>
    <h1>Mensagens de Contato Recebidas</h1>
    
    <?php
    try {
        $sql = "SELECT * FROM contatos ORDER BY data_envio DESC";
        $stmt = $pdo->query($sql);
        
        if ($stmt->rowCount() > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Nome</th><th>E-mail</th><th>Telefone</th><th>Assunto</th><th>Mensagem</th><th>Data</th></tr>";
            
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                echo "<td>" . htmlspecialchars($row['telefone']) . "</td>";
                echo "<td>" . htmlspecialchars($row['assunto']) . "</td>";
                echo "<td>" . htmlspecialchars($row['mensagem']) . "</td>";
                echo "<td>" . $row['data_envio'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Nenhuma mensagem recebida ainda.</p>";
        }
    } catch(PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
    ?>
</body>
</html>