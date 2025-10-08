-- Active: 1737981580652@@127.0.0.1@3306
-- Criar o banco de dados
CREATE DATABASE IF NOT EXISTS aurora_viagens;
USE aurora_viagens;

-- Tabela de cidades
CREATE TABLE cidades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    estado VARCHAR(50) NOT NULL,
    descricao TEXT,
    imagem_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabela de hotéis
CREATE TABLE hoteis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    cidade_id INT NOT NULL,
    endereco VARCHAR(255) NOT NULL,
    telefone VARCHAR(20),
    website VARCHAR(255),
    check_in TIME,
    check_out TIME,
    descricao TEXT,
    imagem_url VARCHAR(255),
    estrelas INT DEFAULT 0,
    preco_medio DECIMAL(10,2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (cidade_id) REFERENCES cidades(id) ON DELETE CASCADE
);

-- Tabela de restaurantes
CREATE TABLE restaurantes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    cidade_id INT NOT NULL,
    endereco VARCHAR(255) NOT NULL,
    telefone VARCHAR(20),
    website VARCHAR(255),
    horario_funcionamento VARCHAR(100),
    tipo_culinaria VARCHAR(100),
    descricao TEXT,
    imagem_url VARCHAR(255),
    preco_medio VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (cidade_id) REFERENCES cidades(id) ON DELETE CASCADE
);

-- Tabela de pontos turísticos
CREATE TABLE pontos_turisticos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    cidade_id INT NOT NULL,
    endereco VARCHAR(255) NOT NULL,
    telefone VARCHAR(20),
    website VARCHAR(255),
    horario_funcionamento VARCHAR(100),
    tipo_atracao VARCHAR(100),
    descricao TEXT,
    imagem_url VARCHAR(255),
    preco_entrada DECIMAL(10,2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (cidade_id) REFERENCES cidades(id) ON DELETE CASCADE
);

-- Tabela de administradores
CREATE TABLE administradores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    nivel_acesso ENUM('admin', 'editor') DEFAULT 'editor',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Inserir dados iniciais
INSERT INTO cidades (nome, estado, descricao, imagem_url) VALUES
('Rio de Janeiro', 'RJ', 'Cidade maravilhosa com praias incríveis e o Cristo Redentor', 'https://images.unsplash.com/photo-1483729558449-99ef09a8c325'),
('São Paulo', 'SP', 'Maior cidade do Brasil, centro financeiro e cultural', 'https://images.unsplash.com/photo-1541745537411-b8046dc6d66c'),
('Foz do Iguaçu', 'PR', 'Famosa pelas Cataratas do Iguaçu, uma das 7 maravilhas naturais', 'https://images.unsplash.com/photo-1544981976-3a5c6d90c2eb'),
('Salvador', 'BA', 'Capital cultural do Brasil com rica história e arquitetura colonial', 'https://images.unsplash.com/photo-1541336032412-2048a678540d'),
('Florianópolis', 'SC', 'Ilha da magia com praias belíssimas e cultura açoriana', 'https://images.unsplash.com/photo-1566393028636-d843b3d0d0b3');

INSERT INTO hoteis (nome, cidade_id, endereco, telefone, website, check_in, check_out, descricao, imagem_url, estrelas, preco_medio) VALUES
('Hotel Copacabana Palace', 1, 'Av. Atlântica, 1702 - Copacabana', '(21) 2548-7070', 'www.copacabanapalace.com.br', '14:00:00', '12:00:00', 'Hotel de luxo icônico localizado na orla de Copacabana', 'https://images.unsplash.com/photo-1566073771259-6a8506099945', 5, 1200.00),
('Hotel Fasano', 2, 'R. Vitório Fasano, 88 - Cerqueira César', '(11) 3896-4000', 'www.fasano.com.br', '15:00:00', '12:00:00', 'Hotel boutique de alto padrão no coração de São Paulo', 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4', 5, 950.00),
('Hotel Belmond', 3, 'Av. das Cataratas, 6845 - Vila Yolanda', '(45) 2102-7000', 'www.belmond.com', '14:00:00', '11:00:00', 'Hotel luxuoso com vista para as Cataratas do Iguaçu', 'https://images.unsplash.com/photo-1584132967334-10e028bd69f7', 5, 800.00);

INSERT INTO restaurantes (nome, cidade_id, endereco, telefone, website, horario_funcionamento, tipo_culinaria, descricao, imagem_url, preco_medio) VALUES
('D.O.M. Restaurante', 2, 'R. Barão de Capanema, 549 - Jardins', '(11) 3088-0761', 'www.domrestaurante.com.br', 'Seg-Sáb: 12h-16h, 19h-00h', 'Gastronomia Brasileira', 'Um dos melhores restaurantes do mundo pelo chef Alex Atala', 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4', 'Alto'),
('Olympe', 1, 'R. Custódio Serrão, 62 - Jardim Botânico', '(21) 2539-4542', 'www.restauranteolympe.com.br', 'Ter-Sáb: 19h-23h', 'Francesa Contemporânea', 'Restaurante premiado com estrela Michelin', 'https://images.unsplash.com/photo-1559339352-11d035aa65de', 'Alto'),
('Cais da Ribeira', 4, 'R. da Gente, 05 - Ribeira', '(71) 3241-6041', 'www.caisdaribeira.com.br', 'Ter-Dom: 12h-23h', 'Frutos do Mar', 'Excelente restaurante de frutos do mar com vista para o mar', 'https://images.unsplash.com/photo-1414235077428-338989a2e8c0', 'Médio');

INSERT INTO pontos_turisticos (nome, cidade_id, endereco, telefone, website, horario_funcionamento, tipo_atracao, descricao, imagem_url, preco_entrada) VALUES
('Cristo Redentor', 1, 'Parque Nacional da Tijuca - Alto da Boa Vista', '(21) 2558-1329', 'www.cristoredentor.com.br', '08:00-19:00', 'Monumento', 'Estátua do Cristo Redentor, uma das 7 maravilhas do mundo', 'https://images.unsplash.com/photo-1516306580123-e6e52b1b7b5f', 62.00),
('Cataratas do Iguaçu', 3, 'Parque Nacional do Iguaçu', '(45) 3521-4400', 'www.cataratasdoiguacu.com.br', '09:00-17:00', 'Natureza', 'Uma das sete maravilhas naturais do mundo', 'https://images.unsplash.com/photo-1544981976-3a5c6d90c2eb', 75.50),
('Pelourinho', 4, 'Centro Histórico - Salvador', '(71) 3321-1963', 'www.pelourinho.salvador.ba.gov.br', '24 horas', 'Centro Histórico', 'Centro histórico de Salvador com arquitetura colonial', 'https://images.unsplash.com/photo-1590086780620-3c7c53b8c7e5', 0.00);

INSERT INTO administradores (nome, email, senha, nivel_acesso) VALUES
('Administrador Principal', 'admin@auroraviagens.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin'),
('Editor Conteúdo', 'editor@auroraviagens.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'editor');

-- Criar índices para melhor performance
CREATE INDEX idx_cidade_id_hoteis ON hoteis(cidade_id);
CREATE INDEX idx_cidade_id_restaurantes ON restaurantes(cidade_id);
CREATE INDEX idx_cidade_id_pontos_turisticos ON pontos_turisticos(cidade_id);