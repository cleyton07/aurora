<?php
// Inicia a sessão
session_start();

// Configurações do banco de dados
define('DB_HOST', 'localhost');
define('DB_NAME', 'sistema_aurora'); // Nome do seu banco de dados
define('DB_USER', 'root');           // Usuário padrão do XAMPP
define('DB_PASS', '');               // Senha (geralmente vazia no XAMPP)

// Tenta realizar a conexão com o banco
try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8",
        DB_USER,
        DB_PASS
    );

    // Define o modo de erro do PDO para exceção
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    // Caso ocorra um erro, exibe a mensagem
    die("❌ ERRO: Não foi possível conectar ao banco de dados.<br>" . $e->getMessage());
}
?>
