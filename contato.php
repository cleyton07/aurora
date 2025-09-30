<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contato - Aurora Viagens</title>
    <style>
        :root {
            --roxo-principal: #6a0dad;
            --roxo-escuro: #4b0082;
            --roxo-claro: #9370db;
            --preto: #000000;
            --cinza-escuro: #1a1a1a;
            --branco: #ffffff;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: var(--preto);
            color: var(--branco);
            line-height: 1.6;
            min-height: 100vh;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        header {
            background: linear-gradient(135deg, var(--roxo-principal), var(--roxo-escuro));
            padding: 30px 0;
            text-align: center;
            border-bottom: 3px solid var(--roxo-claro);
        }
        
        .logo {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--branco);
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }
        
        .tagline {
            font-size: 1.2rem;
            margin-top: 10px;
            color: var(--roxo-claro);
        }
        
        .form-section {
            background-color: var(--cinza-escuro);
            padding: 40px;
            border-radius: 10px;
            margin: 40px auto;
            max-width: 800px;
            box-shadow: 0 5px 15px rgba(106, 13, 173, 0.3);
            border: 1px solid var(--roxo-principal);
        }
        
        h2 {
            color: var(--roxo-claro);
            text-align: center;
            margin-bottom: 30px;
            font-size: 2rem;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            color: var(--roxo-claro);
            font-weight: bold;
        }
        
        input, textarea, select {
            width: 100%;
            padding: 12px;
            border: 2px solid var(--roxo-principal);
            border-radius: 5px;
            background-color: var(--preto);
            color: var(--branco);
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: var(--roxo-claro);
            box-shadow: 0 0 10px rgba(147, 112, 219, 0.5);
        }
        
        textarea {
            height: 150px;
            resize: vertical;
        }
        
        .btn-enviar {
            background: linear-gradient(135deg, var(--roxo-principal), var(--roxo-escuro));
            color: var(--branco);
            border: none;
            padding: 15px 30px;
            border-radius: 5px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .btn-enviar:hover {
            background: linear-gradient(135deg, var(--roxo-escuro), var(--roxo-principal));
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(106, 13, 173, 0.4);
        }
        
        .mensagem {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
            font-weight: bold;
        }
        
        .sucesso {
            background-color: rgba(0, 128, 0, 0.2);
            border: 1px solid green;
            color: lightgreen;
        }
        
        .erro {
            background-color: rgba(255, 0, 0, 0.2);
            border: 1px solid red;
            color: #ff6b6b;
        }
        
        footer {
            background: linear-gradient(135deg, var(--roxo-escuro), var(--preto));
            padding: 20px 0;
            text-align: center;
            margin-top: 50px;
            border-top: 1px solid var(--roxo-principal);
        }
        
        .info-contato {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            margin-top: 30px;
            padding: 20px;
            background-color: var(--cinza-escuro);
            border-radius: 10px;
        }
        
        .info-item {
            text-align: center;
            margin: 10px;
            flex: 1;
            min-width: 200px;
        }
        
        .info-item h3 {
            color: var(--roxo-claro);
            margin-bottom: 10px;
        }
        
        @media (max-width: 768px) {
            .form-section {
                padding: 20px;
                margin: 20px auto;
            }
            
            .info-contato {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">AURORA VIAGENS</div>
            <div class="tagline">Descubra novos horizontes com a gente</div>
        </div>
    </header>

    <div class="container">
        <section class="form-section">
            <h2>Entre em Contato</h2>
            
            <?php
           
            if (isset($_SESSION['mensagem'])) {
                $tipo = $_SESSION['tipo_mensagem'] ?? 'info';
                echo '<div class="mensagem ' . $tipo . '">' . $_SESSION['mensagem'] . '</div>';
                unset($_SESSION['mensagem']);
                unset($_SESSION['tipo_mensagem']);
            }
            ?>
            
            <form action="processa_contato.php" method="POST">
                <div class="form-group">
                    <label for="nome">Nome Completo *</label>
                    <input type="text" id="nome" name="nome" required>
                </div>
                
                <div class="form-group">
                    <label for="email">E-mail *</label>
                    <input type="email" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="telefone">Telefone</label>
                    <input type="tel" id="telefone" name="telefone">
                </div>
                
                <div class="form-group">
                    <label for="assunto">Assunto</label>
                    <select id="assunto" name="assunto">
                        <option value="">Selecione um assunto</option>
                        <option value="Orçamento de Viagem">Orçamento de Viagem</option>
                        <option value="Dúvidas">Dúvidas</option>
                        <option value="Sugestões">Sugestões</option>
                        <option value="Reclamações">Reclamações</option>
                        <option value="Outros">Outros</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="mensagem">Mensagem *</label>
                    <textarea id="mensagem" name="mensagem" placeholder="Conte-nos como podemos ajudar..." required></textarea>
                </div>
                
                <button type="submit" class="btn-enviar">Enviar Mensagem</button>
            </form>
        </section>
        
        <div class="info-contato">
            <div class="info-item">
                <h3>Telefone</h3>
                <p>(11) 9999-9999</p>
            </div>
            <div class="info-item">
                <h3>E-mail</h3>
                <p>contato@auroraviagens.com</p>
            </div>
            <div class="info-item">
                <h3>Horário de Atendimento</h3>
                <p>Segunda a Sexta: 9h às 18h</p>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <p>&copy; 2024 Aurora Viagens. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>