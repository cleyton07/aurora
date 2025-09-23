-- Criar o banco de dados
CREATE DATABASE aurora_viagens;
USE aurora_viagens;

-- Tabela de usuários
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Inserir um usuário de exemplo (opcional)
INSERT INTO usuarios (nome, email, senha) VALUES 
('Usuário Exemplo', 'exemplo@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');