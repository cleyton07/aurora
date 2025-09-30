<?php
require_once 'config.php';

// Verificar se está logado
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header("Location: login.php");
    exit();
}

$erro = '';
$sucesso = '';

// Buscar dados do usuário (apenas colunas básicas primeiro)
$usuario_id = $_SESSION['usuario_id'];
$sql = "SELECT nome, email FROM usuarios WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$usuario_id]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

// Tentar buscar colunas adicionais se existirem
try {
    $sql_extra = "SELECT telefone, endereco, foto_perfil, data_nascimento, bio FROM usuarios WHERE id = ?";
    $stmt_extra = $pdo->prepare($sql_extra);
    $stmt_extra->execute([$usuario_id]);
    $usuario_extra = $stmt_extra->fetch(PDO::FETCH_ASSOC);
    
    // Mesclar os dados
    if ($usuario_extra) {
        $usuario = array_merge($usuario, $usuario_extra);
    }
} catch(PDOException $e) {
    // Se as colunas não existirem, usar valores padrão
    $usuario['telefone'] = '';
    $usuario['endereco'] = '';
    $usuario['foto_perfil'] = '';
    $usuario['data_nascimento'] = '';
    $usuario['bio'] = '';
}

// Processar atualização dos dados
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['atualizar_dados'])) {
    $nome = trim($_POST['nome']);
    $telefone = trim($_POST['telefone']);
    $endereco = trim($_POST['endereco']);
    $data_nascimento = $_POST['data_nascimento'];
    $bio = trim($_POST['bio']);

    try {
        // Verificar quais colunas existem antes de atualizar
        $campos = ['nome = ?'];
        $valores = [$nome];
        
        // Adicionar apenas campos que existem
        if (isset($usuario['telefone'])) {
            $campos[] = 'telefone = ?';
            $valores[] = $telefone;
        }
        if (isset($usuario['endereco'])) {
            $campos[] = 'endereco = ?';
            $valores[] = $endereco;
        }
        if (isset($usuario['data_nascimento'])) {
            $campos[] = 'data_nascimento = ?';
            $valores[] = $data_nascimento;
        }
        if (isset($usuario['bio'])) {
            $campos[] = 'bio = ?';
            $valores[] = $bio;
        }
        
        $valores[] = $usuario_id;
        
        $sql = "UPDATE usuarios SET " . implode(', ', $campos) . " WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        
        if ($stmt->execute($valores)) {
            $_SESSION['usuario_nome'] = $nome;
            $sucesso = "Dados atualizados com sucesso!";
            // Recarregar dados do usuário
            $stmt = $pdo->prepare("SELECT nome, email FROM usuarios WHERE id = ?");
            $stmt->execute([$usuario_id]);
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        }
    } catch(PDOException $e) {
        $erro = "Erro ao atualizar dados: " . $e->getMessage();
    }
}

// Processar upload de foto (só funciona se a coluna existir)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['foto_perfil']) && isset($usuario['foto_perfil'])) {
    $foto = $_FILES['foto_perfil'];
    
    // Verificar se é uma imagem
    $check = getimagesize($foto["tmp_name"]);
    if($check !== false) {
        // Criar pasta de uploads se não existir
        if (!is_dir('uploads')) {
            mkdir('uploads', 0777, true);
        }
        
        // Gerar nome único para a imagem
        $extensao = pathinfo($foto["name"], PATHINFO_EXTENSION);
        $nome_arquivo = "perfil_" . $usuario_id . "_" . time() . "." . $extensao;
        $caminho_arquivo = "uploads/" . $nome_arquivo;
        
        // Mover arquivo
        if (move_uploaded_file($foto["tmp_name"], $caminho_arquivo)) {
            // Atualizar no banco
            $sql = "UPDATE usuarios SET foto_perfil = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute([$caminho_arquivo, $usuario_id])) {
                $sucesso = "Foto de perfil atualizada com sucesso!";
                $usuario['foto_perfil'] = $caminho_arquivo;
            }
        } else {
            $erro = "Erro ao fazer upload da imagem.";
        }
    } else {
        $erro = "O arquivo não é uma imagem válida.";
    }
}

// Processar alteração de senha
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['alterar_senha'])) {
    $senha_atual = $_POST['senha_atual'];
    $nova_senha = $_POST['nova_senha'];
    $confirmar_senha = $_POST['confirmar_senha'];
    
    // Verificar senha atual
    $sql = "SELECT senha FROM usuarios WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$usuario_id]);
    $usuario_db = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (password_verify($senha_atual, $usuario_db['senha'])) {
        if ($nova_senha === $confirmar_senha) {
            if (strlen($nova_senha) >= 6) {
                $nova_senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT);
                $sql = "UPDATE usuarios SET senha = ? WHERE id = ?";
                $stmt = $pdo->prepare($sql);
                if ($stmt->execute([$nova_senha_hash, $usuario_id])) {
                    $sucesso = "Senha alterada com sucesso!";
                }
            } else {
                $erro = "A nova senha deve ter pelo menos 6 caracteres.";
            }
        } else {
            $erro = "As senhas não coincidem.";
        }
    } else {
        $erro = "Senha atual incorreta.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Perfil - Aurora Viagens</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            font-family: 'Arial', sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #000000, #4b0082, #6a0dad);
            min-height: 100vh;
            color: var(--branco);
            padding: 20px;
        }
        
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: rgba(0, 0, 0, 0.9);
            border-radius: 15px;
            overflow: hidden;
            border: 2px solid var(--roxo-principal);
        }
        
        .header {
            background: linear-gradient(135deg, var(--roxo-principal), var(--roxo-escuro));
            padding: 30px;
            text-align: center;
        }
        
        .logo {
            font-size: 2rem;
            color: var(--branco);
            margin-bottom: 10px;
        }
        
        .nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 30px;
            background: var(--cinza-escuro);
        }
        
        .btn-voltar {
            padding: 10px 20px;
            background: var(--roxo-principal);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: all 0.3s;
        }
        
        .btn-voltar:hover {
            background: var(--roxo-escuro);
        }
        
        .profile-content {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 30px;
            padding: 30px;
        }
        
        .profile-sidebar {
            text-align: center;
        }
        
        .profile-picture {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid var(--roxo-principal);
            margin-bottom: 20px;
        }
        
        .upload-btn {
            display: inline-block;
            padding: 10px 20px;
            background: var(--roxo-principal);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s;
            margin-bottom: 20px;
        }
        
        .upload-btn:hover {
            background: var(--roxo-escuro);
        }
        
        .user-info-sidebar h3 {
            color: var(--roxo-claro);
            margin-bottom: 10px;
        }
        
        .user-info-sidebar p {
            margin-bottom: 5px;
            color: #ccc;
        }
        
        .profile-main {
            background: var(--cinza-escuro);
            padding: 30px;
            border-radius: 10px;
        }
        
        .section {
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #333;
        }
        
        .section h2 {
            color: var(--roxo-claro);
            margin-bottom: 20px;
        }
        
        .form-group {
            margin-bottom: 20px;
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
            border-radius: 8px;
            background: var(--preto);
            color: var(--branco);
            font-size: 16px;
            transition: all 0.3s;
        }
        
        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: var(--roxo-claro);
            box-shadow: 0 0 10px rgba(147, 112, 219, 0.5);
        }
        
        textarea {
            height: 100px;
            resize: vertical;
        }
        
        .btn {
            padding: 12px 25px;
            background: linear-gradient(135deg, var(--roxo-principal), var(--roxo-escuro));
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(106, 13, 173, 0.4);
        }
        
        .mensagem {
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: bold;
        }
        
        .erro {
            background: rgba(255, 0, 0, 0.1);
            border: 1px solid #ff4444;
            color: #ff6b6b;
        }
        
        .sucesso {
            background: rgba(0, 255, 0, 0.1);
            border: 1px solid #00cc00;
            color: #90ee90;
        }
        
        .password-form {
            background: rgba(0, 0, 0, 0.3);
            padding: 20px;
            border-radius: 10px;
            border: 1px solid var(--roxo-principal);
        }
        
        .aviso {
            background: rgba(255, 165, 0, 0.1);
            border: 1px solid #ffa500;
            color: #ffb347;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 0.9rem;
        }
        
        @media (max-width: 768px) {
            .profile-content {
                grid-template-columns: 1fr;
            }
            
            .profile-sidebar {
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">🌌 Aurora Viagens</div>
            <h1>Meu Perfil</h1>
        </div>
        
        <div class="nav">
            <a href="../aurora/index.php" class="btn-voltar">
                <i class="fas fa-arrow-left"></i> Voltar para Home
            </a>
            <span>Olá, <?php echo $usuario['nome']; ?>!</span>
        </div>
        
        <?php if ($erro): ?>
            <div class="mensagem erro"><?php echo $erro; ?></div>
        <?php endif; ?>
        
        <?php if ($sucesso): ?>
            <div class="mensagem sucesso"><?php echo $sucesso; ?></div>
        <?php endif; ?>
        
        <?php if (!isset($usuario['telefone'])): ?>
            <div class="mensagem aviso">
                <i class="fas fa-exclamation-triangle"></i>
                Algumas funcionalidades estão limitadas. Execute o SQL de atualização do banco de dados.
            </div>
        <?php endif; ?>
        
        <div class="profile-content">
            <!-- Sidebar com foto e info básica -->
            <div class="profile-sidebar">
                <div class="photo-section">
                    <img src="<?php echo !empty($usuario['foto_perfil']) ? $usuario['foto_perfil'] : 'https://via.placeholder.com/200x200/6a0dad/ffffff?text=Sem+Foto'; ?>" 
                         alt="Foto de Perfil" class="profile-picture" id="profilePicture">
                    
                    <?php if (isset($usuario['foto_perfil'])): ?>
                    <form method="POST" enctype="multipart/form-data" class="upload-form">
                        <input type="file" name="foto_perfil" id="fotoInput" accept="image/*" style="display: none;" onchange="this.form.submit()">
                        <button type="button" class="upload-btn" onclick="document.getElementById('fotoInput').click()">
                            <i class="fas fa-camera"></i> Alterar Foto
                        </button>
                    </form>
                    <?php else: ?>
                    <div class="aviso">
                        Upload de foto indisponível
                    </div>
                    <?php endif; ?>
                </div>
                
                <div class="user-info-sidebar">
                    <h3>Informações</h3>
                    <p><strong>Email:</strong> <?php echo $usuario['email']; ?></p>
                    <p><strong>Membro desde:</strong> <?php echo date('d/m/Y'); ?></p>
                </div>
            </div>
            
            <!-- Conteúdo principal -->
            <div class="profile-main">
                <!-- Seção de Dados Pessoais -->
                <div class="section">
                    <h2><i class="fas fa-user"></i> Dados Pessoais</h2>
                    <form method="POST">
                        <input type="hidden" name="atualizar_dados" value="1">
                        
                        <div class="form-group">
                            <label for="nome">Nome Completo</label>
                            <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($usuario['nome']); ?>" required>
                        </div>
                        
                        <?php if (isset($usuario['telefone'])): ?>
                        <div class="form-group">
                            <label for="telefone">Telefone</label>
                            <input type="tel" id="telefone" name="telefone" value="<?php echo htmlspecialchars($usuario['telefone'] ?? ''); ?>">
                        </div>
                        <?php endif; ?>
                        
                        <?php if (isset($usuario['data_nascimento'])): ?>
                        <div class="form-group">
                            <label for="data_nascimento">Data de Nascimento</label>
                            <input type="date" id="data_nascimento" name="data_nascimento" value="<?php echo $usuario['data_nascimento'] ?? ''; ?>">
                        </div>
                        <?php endif; ?>
                        
                        <?php if (isset($usuario['endereco'])): ?>
                        <div class="form-group">
                            <label for="endereco">Endereço</label>
                            <textarea id="endereco" name="endereco"><?php echo htmlspecialchars($usuario['endereco'] ?? ''); ?></textarea>
                        </div>
                        <?php endif; ?>
                        
                        <?php if (isset($usuario['bio'])): ?>
                        <div class="form-group">
                            <label for="bio">Biografia</label>
                            <textarea id="bio" name="bio" placeholder="Conte um pouco sobre você..."><?php echo htmlspecialchars($usuario['bio'] ?? ''); ?></textarea>
                        </div>
                        <?php endif; ?>
                        
                        <button type="submit" class="btn">Atualizar Dados</button>
                    </form>
                </div>
                
                <!-- Seção de Alteração de Senha -->
                <div class="section">
                    <h2><i class="fas fa-lock"></i> Alterar Senha</h2>
                    <form method="POST" class="password-form">
                        <input type="hidden" name="alterar_senha" value="1">
                        
                        <div class="form-group">
                            <label for="senha_atual">Senha Atual</label>
                            <input type="password" id="senha_atual" name="senha_atual" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="nova_senha">Nova Senha</label>
                            <input type="password" id="nova_senha" name="nova_senha" required minlength="6">
                        </div>
                        
                        <div class="form-group">
                            <label for="confirmar_senha">Confirmar Nova Senha</label>
                            <input type="password" id="confirmar_senha" name="confirmar_senha" required minlength="6">
                        </div>
                        
                        <button type="submit" class="btn">Alterar Senha</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Preview da imagem antes de fazer upload
        document.getElementById('fotoInput')?.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profilePicture').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>