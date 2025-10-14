CREATE DATABASE IF NOT EXISTS formulario_contatos CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE formulario_contatos;

CREATE TABLE IF NOT EXISTS mensagems (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefone VARCHAR(20),
    assunto VARCHAR(150),
    mensagem TEXT NOT NULL,
    data_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
